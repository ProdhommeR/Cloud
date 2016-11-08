<?php
use micro\db\Database;
class Install {
	public function initialize() {
	}
	public Static function run() {
		$db = new Database ( "" );
		$db->connect ();
		$sql = $db->query ( "SHOW databases like 'cloud2'" );
		$sql->setFetchMode ( PDO::FETCH_OBJ );
		
		if ($sql->fetch ()) {
			$base = 0;
			echo "La base de donnée existe ! ";
		} else {
			$base = 1;
			echo "La base de donnée n'existe pas !! ";
		}
		
		if (file_exists ( ROOT . "config.php" )) {
			
			echo "<br> Fichier config.php trouvé ! ";
			global $config;
			$data = $config ["database"];
			print_r ( $data );
			if (! array_key_exists ( "dbName", $data ) || empty ( @$data ["dbName"] )) {
				if (! array_key_exists ( "dbName", $data )) {
				}
				echo " <br> c vidd :) !";
			}
			if (! array_key_exists ( "serverName", $data ) || empty ( @$data ["serverName"] )) {
				echo " <br> c vidd :) !";
			}
			if (! array_key_exists ( "port", $data ) || empty ( @$data ["port"] )) {
				echo " <br> c vidd :) !";
			}
			if (! array_key_exists ( "user", $data ) || empty ( @$data ["user"] )) {
				echo " <br> c vidd :) !";
			}
			if (! array_key_exists ( "password", $data )) {
				echo " <br> c vidd :) !";
			}
			$version = phpversion ();
			$version_sql = mysqli_get_client_info ();
			echo "<br> Version de php :", $version;
			echo "<br> Version de MySql :", $version_sql;
		} else {
			echo " <br> Fichier config.php non trouvé ! ";
		}
		Install::View ( $data ["dbName"], $data ["serverName"], $data ["port"], $data ["user"] );
	}
	public static function View($dbName = NULL, $serverName = NULL, $port = NULL, $user = NULL, $base = NULL) {
		$version = phpversion ();
		$version_sql = mysqli_get_client_info ();
		echo "<!DOCTYPE html>
		<html>
		<head>
		<meta charset='UTF-8'>
		<title>CLOUD</title>
		</head>
		<body>
		<div class='well well-lg'>
		<fieldset>
		<legend> Vérification configuration</legend>
		<p> Version php : '$version' </p>
		<p> Version MYSQL : '$version_sql' </p>
		<p> Mod Rewrite : </p>
		</fieldset>
		<fieldset>
		<legend> Configuration </legend>
		<form action='' method='post'>
		<input type='hidden' name='base' value='" . $base . "'>
			<input type='hidden' name='envoi'>
		Url : <input type='text' name='url' value='" . $serverName . "' placeholder='' ><br>
		<br/>
		BDD : <input type='text' name='dbName' value='" . $dbName . "'><br>
		<br/>
		Utilisateur <input type='text' name='user'  value='" . $user . "'><br>
		<br/>
		Mot de passe : <input type='text' name='mdp' placeholder=''><br>
		<br/>
		
		<input type='submit' value='Valider'>
		</form>
		</fieldset>
		
		</div>
		</body>
		</html>";
	}
	public static function modif() {
		global $config;
		$data = $config ["database"];
		
		$nomBase = $_POST ['dbName'];
		$url = $_POST ['url'];
		$nomUser = $_POST ['user'];
		$mdp = $_POST ['mdp'];
		$basecree = $_POST ['base'];
			$filename = 'app/database/cloud2.sql';
			$mysql_host = '$url';
			$mysql_username = '$nomUser';
			$mysql_password = '$mdp';
			$mysql_database = '$nomBase';
			
			$conn = new mysqli ( $url, $nomUser, $mdp );
			$sql = "CREATE DATABASE $nomBase";
			if ($conn->query ( $sql ) === TRUE) {
				echo "<br />Base de données créée";
			} else {
				echo "<br />Erreur lors de la création : " . $conn->error;
			}
			$conn = new mysqli($url, $nomUser, $mdp, $nomBase, 3306);
				
			@$link = mysql_connect($url, $nomUser, $mdp);
			$db_selected = mysql_select_db($nomBase, $link);
			$templine = '';
			$lines = file($filename);
			foreach ($lines as $line)
			{
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
					$templine .= $line;
					if (substr(trim($line), -1, 1) == ';')
					{
						mysql_query($templine) or print('Erreur lors de la requete \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
						$templine = '';
					}
			}
			echo " & tables importées avec succès !";
			
			$file = ("app/config.php");
			$current = file_get_contents($file);
			$current =
			'<?php
return array(
		"siteUrl"=>"http://'.$url.'/cloud/",
		"documentRoot"=>"Accueil",
		"database"=>[
				"dbName"=>"'.$nomBase.'",
				"serverName"=>"'.$url.'",
				"port"=>"3306",
				"user"=>"'.$nomUser.'",
				"password"=>"'.$mdp.'"
		],
		"onStartup"=>function($action){
		},
		"directories"=>["libraries"],
		"templateEngine"=>\'micro\views\engine\Twig\',
		"templateEngineOptions"=>array("cache"=>false),
		"test"=>false,
		"debug"=>false,
		"cloud"=>array(\'root\'=>\'files/\',
				\'prefix\'=>\'srv-\')
);';
			file_put_contents($file, $current);
			rename("InstallPHP.php","InstallPHP2.php");
			}
			}
			if (!isset($_POST["envoi"])){
				Install::run();
			}else{
				Install::modif();
			}
