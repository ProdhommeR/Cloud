<?php
class Tarifs extends \_DefaultController {
	public function isValid(){
		return Auth::isAuth();
	}
	public function onInvalidControl(){
		$this->messageDanger("Vous n'êtes pas autoriser à afficher cette page !",3000,false);
		$this->forward("Accueil");
		exit();
	}
	public function __construct() {
		// TODO Auto-generated method stub
		parent::__construct ();
		$this->model = "Tarif";
		$this->title = "Tarif";
	}
	public function frm($id = NULL) {
		$tarif = $this->getInstance ( $id );
		$this->loadView("Tarif/edit.html",array("tarif"=>$tarif));
	}
}