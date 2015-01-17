<?php 

	define('DIR_CONFIG','D:/Dev/www/coffee-dashboard/core/');

	include( DIR_CONFIG . 'config.php');
	include( DIR_MDL . 'Session.php' );
	include( DIR_MDL . 'User.php' );
	include( DIR_MDL . 'Database.php' );
	include( DIR_TOOLS . 'PassHash.php' );
	session_start();

	if (Session::check_logged()) {
		include(DIR_CTL . 'default.php');
	}
	else {
		include(DIR_CTL . 'user/login.php');
	}

?>
	
