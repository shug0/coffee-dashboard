<?php 

define('DIR_CONFIG', dirname(dirname(__DIR__)) . "\\");
include_once(DIR_CONFIG . 'config.php');
function __autoload($class_name) { include DIR_MDL . $class_name . '.php'; }
session_start();

if (isset($_SESSION['session'])) 
{
	$_SESSION['session']->logout(); 
	header('Location: ' . URL_WEB);      
}
else 
{
	header('Location: ' . URL_WEB);      
} 

?>

