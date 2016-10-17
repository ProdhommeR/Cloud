<?php
use micro\controllers\Controller;
use micro\js\Jquery;
use micro\utils\RequestUtils;
class MyDisques extends Controller {
	public function initialize() {
		if (! RequestUtils::isAjax ()) {
			$this->loadView ( "main/vHeader.html", array (
					"infoUser" => Auth::getInfoUser () 
			) );
		}
	}
	public function index() {
		echo Jquery::compile ();
	}
	public function finalize() {
		if (! RequestUtils::isAjax ()) {
			$this->loadView ( "main/vFooter.html" );
		}
	}
	public function __construct() {
		parent::__construct ();
		$this->title = "Disques";
		$this->model = "Disque";
	}


public function Disques($search = NULL) {
		$where = "1=1";
		if (isset ( $search )) {
			$where = "id like '%($search)%' or nom like '%($search)%'";
		}
		$users = DAO::getAll ( "Disque", $where );
		$this->loadView ( "First/disque.html", array (
				"disques" => $disque 
		) );
		echo Jquery::getOn ( "click", ".c_disque", "First/showdisque", "#divDisque" );

	public function Disques($search = NULL) {
		$where = "idutilisateur=" . Auth::getUser ()->getId ();
		if (isset ( $search )) {
			$where .= " and nom like '%" . $search . "%'";
		}
		$disques = DAO::getAll ( "Disque", $where );
		$this->loadView ( "disques/MesDisques.html", array (
				"disques" => $disques 
		) );
		 echo Jquery::getOn ( "click", ".c_disque", "MyDisques/showDisk", "#divDisk" );
	}
	public function showDisk($id) {
		$disque = DAO::getOne ( "Disque", $id );
		if (is_null ( $disque ) === false) {
			echo "Nom du disque : " . $disque->getnom () . "<br>";
			echo "Mémoire allouée : " . DirectoryUtils::formatBytes($disque->getQuota ()). "<br>";
			echo "Tarif : ".$disque->getTarif();
		} else {
			
		}
	}
}

	
	