<?php
use micro\controllers\Startup;
use micro\controllers\Autoloader;
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath('app').DS);

$config=include_once ROOT.'config.php';

require_once ROOT.'micro/controllers/Autoloader.php';
require_once ROOT.'./../vendor/autoload.php';

Autoloader::register();
if (!file_exists("Install/InstallPHP.php")){
	include "Install/InstallPHP.php";
	exit();
}
Startup::run();


//RProdhomme