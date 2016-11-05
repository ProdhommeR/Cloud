<?php
/*class Install extends \_DefaultController {
	public function index() {*/
		if (file_exists ( "InstallPHP.php" )) {
			echo "Fichier trouvé";
			if (file_exists ( "../app/config.php" )) {
				echo "<br> Fichier config.php trouvé ! ";
				global $config;
				$data = $config ["database"];
				print_r($data);
				if (! array_key_exists ( "dbName", array($data) ) || empty ( @$data ["dbName"] )) {
					if (! array_key_exists ( "dbName", array($data) )) {
					}
					echo " <br> c vidd :) !";
				}
				if (! array_key_exists ( "serverName", array (
						$data 
				) ) || empty ( @$data ["serverName"] )) {
					echo " <br> c vidd :) !";
				}
				if (! array_key_exists ( "port", array (
						$data 
				) ) || empty ( @$data ["port"] )) {
					echo " <br> c vidd :) !";
				}
				if (! array_key_exists ( "user", array (
						$data 
				) ) || empty ( @$data ["user"] )) {
					echo " <br> c vidd :) !";
				}
				if (! array_key_exists ( "password", array (
						$data 
				) )) {
					echo " <br> c vidd :) !";
				}
				// $this->loadView("/Install/InstallView.html");
				$version = phpversion ();
				$version_sql = mysqli_get_client_info ();
				echo "<br> Version de php :", $version;
				echo "<br> Version de MySql :", $version_sql;
			} else {
				echo " <br> Fichier config.php non trouvé ! ";
			}
		}
	/*}
}*/