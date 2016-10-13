<?php
use micro\controllers\Controller;
use micro\js\Jquery;
use micro\utils\RequestUtils;
use micro\orm\DAO;
class MyDisques extends Controller {
	public function isValid() {
		return Auth::isAuth ();
	}
	public function onInvalidControl() {
		$this->messageDanger ( "Vous n'êtes pas autoriser à afficher cette page !", 3000, false );
		$this->forward ( "Accueil" );
		exit ();
	}
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
		
		$where = "idutilisateur=".Auth::getUser()->getId();
		if(isset($search)){
			$where.=" and nom like '%".$search."%'";
		}
		$disques = DAO::getAll ( "Disque", $where );
		$this->loadView ( "disques/MesDisques.html", array (
				"disques" => $disques 
		) );
		//echo Jquery::getOn ( "click", ".c_disque", "First/showUser", "#divUser" );
			
	
	

}

/*public function Disques($search = NULL) {
		$where = "1=1";
		if (isset ( $search )) {
			$where = "id like '%($search)%' or nom like '%($search)%'";
		}
		$users = DAO::getAll ( "Disque", $where );
		$this->loadView ( "First/disque.html", array (
				"disques" => $disque 
		) );
		echo Jquery::getOn ( "click", ".c_disque", "First/showdisque", "#divDisque" );
	}*/
}

	
	