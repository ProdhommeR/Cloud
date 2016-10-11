<?php
use micro\utils\RequestUtils;
use micro\orm\DAO;
class Disques extends \_DefaultController {
	public function __construct() {
		parent::__construct ();
		$this->title = "Disques";
		$this->model = "Disque";
	}
	public function isValid() {
		return Auth::isAuth ();
	}
	public function onInvalidControl() {
		$this->messageDanger ( "Vous n'êtes pas autoriser à afficher cette page !", 3000, false );
		$this->forward ( "Accueil" );
		exit ();
	}
	public function create() {
		if (RequestUtils::isPost ()) {
			global $config;
			$user = Auth::getUser ();
			$disque = new Disque ();
			$file = $_POST ["nom"];
			$file=preg_replace('/[^A-Za-z0-9 _ .-]/', '', $file);
			RequestUtils::setValuesToObject ( $disque, $_POST );
			$disque->setNom($file);
			// $user= DAO::getOne("Utilisateur",$_POST["idUtilisateur"]);
			$disque->setUtilisateur ( Auth::getUser () );
			foreach ( $_POST ["numServices"] as $numServices ) {
				$service = DAO::getOne ( "Service", $numServices );
				$disque->addService ( $service );
			}
			$cloud = $config ["cloud"];
			$Path = $cloud ["root"] . "/" . $cloud ["prefix"] . $user->getLogin () . "/" . $file;
			try {
				if (file_exists($Path)){
						$this->messageDanger("!!! Disque déjà existant !!!");
	
				}else {
					DAO::insert ( $disque, true );
					$tarif = DAO::getOne ( "Tarif", $_POST ["numTarif"] );
					$disqueTarif = $disque->addTarif ( $tarif );
					DAO::insert ( $disqueTarif );
					DirectoryUtils::mkDir($Path,0777,true);
					echo "Votre disque &nbsp;'", $disque->toString () . "'&nbsp;a été créé...";
					
				}
			
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo "Erreur...";
			}
			
			
			
		} else {
			$services = DAO::getAll ( "Service" );
			$tarif = DAO::getAll ( "Tarif" );
			$this->loadView ( "disques/create.html", array (
					"services" => $services,
					"tarifs" => $tarif,
					"user" => Auth::getUser () 
			) );
		}
	}
}