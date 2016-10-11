<?php
use micro\controllers\Controller;
use micro\js\Jquery;
use micro\utils\RequestUtils;
class MyDisques extends Controller{
	public function initialize(){
		if(!RequestUtils::isAjax()){
			$this->loadView("main/vHeader.html",array("infoUser"=>Auth::getInfoUser()));
		}
	}
	public function index() {
		echo Jquery::compile();
	}
	
	public function finalize(){
		if(!RequestUtils::isAjax()){
			$this->loadView("main/vFooter.html");
		}
	}
	
	public function __construct() {
		parent::__construct ();
		$this->title = "Disques";
		$this->model = "Disque";
	}

}

/*public function Users($search = NULL) {
		$where = "1=1";
		if (isset ( $search )) {
			$where = "login like '%($search)%' or mail like '%($search)%'";
		}
		$users = DAO::getAll ( "Utilisateur", $where );
		$this->loadView ( "First/users.html", array (
				"users" => $users 
		) );
		echo Jquery::getOn ( "click", ".c_user", "First/showUser", "#divUser" );
	}
	*/