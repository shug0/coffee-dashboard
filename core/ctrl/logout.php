<?php 

	// LOGOUT PAGE

	define('DIR_CONFIG','D:/Dev/www/coffee-dashboard/core/');

	include( DIR_CONFIG . 'config.php');
	include( DIR_MDL . 'Session.php' );
	session_start();

	if (isset($_SESSION['session'])) {
		if ($_SESSION['session']->logout()) {
			header('location: ' . URL_WEB);
		}
	}
	else {
		header('location: ' . URL_WEB);
	}

 ?>