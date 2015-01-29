<?php 

	define('DIR_CONFIG','D:/Dev/www/coffee-dashboard/core/');

	include( DIR_CONFIG . 'config.php');
	include( DIR_MDL . 'Session.php' );
	include( DIR_MDL . 'User.php' );
	include( DIR_MDL . 'Database.php' );
	include( DIR_TOOLS . 'PassHash.php' );
	session_start();

	if (isset($_SESSION['session'])) {
		if ($_SESSION['session']->is_logged()) {
			include(DIR_CTL . 'dashboard.php');
		}
		else {
			header('Location: http://thatsthefinger.com/');
		}
	}
	else {
		//include(DIR_CTL . 'user/login.php');
		include(DIR_CTL . 'dashboard.php');

	}


?>
	
