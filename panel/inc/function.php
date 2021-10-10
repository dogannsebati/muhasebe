<?php
date_default_timezone_set('Europe/Istanbul');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('ROOT_DIR', 			realpath(__DIR__ .'/../').'/');
define('CLASS_LOAD_DIR', 	ROOT_DIR.'helper/');
spl_autoload_register(function ($class) {
    require_once CLASS_LOAD_DIR. $class . '.php';
});

require_once( 'include.php' );

$bugün = date("Y-m-d");

?>