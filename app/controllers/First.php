<?php
use micro\controllers\Controller;
use micro\orm\DAO;
use micro\js\Jquery;
use micro\utils\RequestUtils;
class First extends Controller {
	public function initialize() {
		if (RequestUtils::isAjax () === false) {
			$this->loadView ( "main/vHeader.html" );
		}
	}
	public function finalize() {
		if (RequestUtils::isAjax () === false) {
			$this->loadView ( "main/vFooter.html" );
		}
	}
	public function index() {
		echo "test";
	}
	public function Users($search = NULL) {
		$where = "1=1";
		if (isset ( $search )) {
			$where = "login like '%($search)%' or mail like '%($search)%'";
		}
		$users = DAO::getAll ( "Utilisateur", $where );
		$this->loadView ( "First/users.html", array ("users" => $users ) );
		echo Jquery::getOn ( "click", ".c_user", "First/showUser", "#divUser" );
	}
	public function showUser($idUser) {
		$user = DAO::getOne ( "Utilisateur", $idUser );
		if (is_null ( $user ) === false) {
			echo "Login : " . $user->getLogin () . "<br>";
			echo "Mail : " . $user->getMail ();
		} else {
			echo "Aucun utilisateur à l'id ($idUser)";
		}
	}
	public function addUser() {
		if (RequestUtils::isPost ()) {
			$user = new Utilisateur ();
			RequestUtils::setValuesToObject ( $user, $_POST );
			if (DAO::insert ( $user )) {
				echo $user->toString () . "crée";
			} else {
				echo "Erreur de l'ajout";
			}
		} else {
			$this->loadView ( "First/addUser.html" );
		}
	}
	public function connexion(){
		$_SESSION["user"]=DAO::getOne("Utilisateur", "login= ","password= ");
		$this->loadView("First/connexion.html");
	}
}