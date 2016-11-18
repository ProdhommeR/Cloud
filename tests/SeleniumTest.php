<?php
use micro\orm\DAO;
class SeleniumTest extends \AjaxUnitTest {
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass ();
		DAO::connect ( "cloud" );
	}
	/*
	 * public function testDefault(){
	 * $this->assertPageContainsText("Hello Selenium");
	 * $this->assertTrue($this->elementExists("#frm"));
	 * $this->assertTrue($this->elementExists("#text"));
	 * }
	 *
	 * /*public function testPost(){
	 * $this->getElementById("text")->sendKeys("okay");
	 * $this->getElementById("text")->sendKeys("\xEE\x80\x87");
	 * SeleniumTest::$webDriver->manage()->timeouts()->implicitlyWait(5);
	 * $this->assertEquals("okay",$this->getElementById("result")->getText());
	 * }
	 */
	
	/*
	 * public function testClick(){
	 * self::get("Selenium/index");
	 * $this->getElementById("text2")->sendKeys("test click");
	 * $this->getElementById("btSubmit")->click();
	 * SeleniumTest::$webDriver->manage()->timeouts()->implicitlyWait(5);
	 * $this->assertEquals("test click",$this->getElementById("result")->getText());
	 * }
	 */
	/*
	 * public function testConnexion() {
	 * self::get ( "First/connexion" );
	 * $user = DAO::getOne ( "Utilisateur", "admin=1" );
	 * $this->getElementById ( "login" )->sendKeys ( $user->getLogin() );
	 * $this->getElementById ( "password" )->sendKeys ( $user->getPassword() );
	 * $this->getElementById ( "btSubmit" )->click();
	 * SeleniumTest::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
	 * $this->assertPageContainsText($user->getLogin());
	 * }
	 */
	public function testDisconnect() {
		self::get ( "First/connexion" );
		$user = DAO::getOne ( "Utilisateur", "admin=1" );
		$this->getElementById ( "login" )->sendKeys ( $user->getLogin () );
		$this->getElementById ( "password" )->sendKeys ( $user->getPassword () );
		$this->getElementById ( "btSubmit" )->click ();
		SeleniumTest::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
		$this->assertPageContainsText ( $user->getLogin () );
		self::get ( "Accueil/disconnect" );
		$this->getElementById ( "btSubmitdc" )->click ();
		SeleniumTest::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
	}
	public function testInscription() {
		$this->getElementById ( "login" )->sendKeys ( "TestClicLogin" );
		$this->getElementById ( "password" )->sendKeys ( "TestClicPassword" );
		$this->click ( "btSubmit", "data-sel" );
		self::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
		$this->assertTrue ( DAO::getOne ( "Utilisateur", "login='TestClicLogin'", "password='TestClicPassword'", "nom='TestClicNom'", "prenom='TestClicPrenom'", "mail='Test@Mail.clic'", "tel='07357731'", "admin='0'" ) );
	}
}