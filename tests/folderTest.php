<?php
class folderTest extends \PHPUnit_Framework_TestCase {
	public function setUp(){
		global $config;
		$this->config=$config;
		
	}
	public function testConfigOk(){
		$this->assertArrayHasKey("siteUrl", $this->config);
	}
	public function testBaseDirectoryExist(){
		$cloud=$this->config["cloud"];
		$this->assertTrue(file_exists("./../".	$cloud["root"]));
	}
	public function testCreateFolder (){
		$cloud =$this->config["cloud"];
		$pathname="./../".$cloud["root"]."/".$cloud["prefix"]."-test";
		$this->assertFalse(file_exists($pathname));
		DirectoryUtils::mkDir($pathname);
		$this->assertFileExists($pathname);
		rmdir($pathname);
		
	}
}