<?php
class SeleniumTest extends \AjaxUnitTest {
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass ();
		self::get ( "Selenium/index" );
	}
	public function testDefault() {
		$this->assertPageContainsText ( 'Hello Selenium' );
		$this->assertTrue ( $this->elementExists ( "#text" ) );
		$this->assertTrue ( $this->elementExists ( "#frm" ) );
	}
	public function testpost() {
		$this->getElementById ( "text" )->sendKeys ( "okay" );
		$this->getElementById ( "text" )->sendKeys ( "\xEE\x80\x87" );
		SeleniumTest::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
		$this->assertEquals ( "okay", $this->getElementById ( "result" )->getText () );
	}
	public function testclick(){
		self::get ( "Selenium/index" );
		$this->getElementById ( "text2" )->sendKeys ( "testclick" );
		$this->getElementById ( "btSubmit" )->click();
		SeleniumTest::$webDriver->manage ()->timeouts ()->implicitlyWait ( 5 );
		$this->assertEquals ( "testclick", $this->getElementById ( "result" )->getText () );
	}
}
