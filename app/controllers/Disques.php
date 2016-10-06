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
		return Auth::isAuth();
	}
	public function onInvalidControl() {
		$this->messageDanger ( "Vous n'êtes pas autoriser à afficher cette page !", 3000, false );
		$this->forward("Accueil");
		exit ();
	}
	public function create() {
		if(RequestUtils::isPost()){
			$disque = new Disque ();
			RequestUtils::setValuesToObject ( $disque, $_POST );
			// $user= DAO::getOne("Utilisateur",$_POST["idUtilisateur"]);
			$disque->setUtilisateur ( Auth::getUser () );
			foreach ( $_POST ["numServices"] as $numServices ) {
				$service = DAO::getOne ( "Service", $numServices );
				$disque->addService ( $service );
			}
			foreach ($_POST["numTarifs"] as $numTarifs){
				$tarif=DAO::getOne("DisqueTarif", $numTarifs);
				$disque->addTarif($tarif);
			}
			try {
			DAO::insert ( $disque,true );
			echo "Votre disque &nbsp;'", $disque->toString(). "'&nbsp;a été créée...";
			}catch (Exception $e){
				echo "Erreur...";
			}
			
		}else{
			$services=DAO::getAll("Service");
			$tarif=DAO::getAll("Tarif");
			$this->loadView("disques/create.html",array("services"=>$services,"tarifs"=>$tarif,"user"=>Auth::getUser()));
			
		}
		
	}
}