<?php 
	define('DIR_CONFIG','D:/Dev/www/coffee-dashboard/core/');

	require( DIR_CONFIG . 'config.php');
	include( DIR_MDL . 'Session.php' );
	include( DIR_MDL . 'User.php' );
	include( DIR_MDL . 'Database.php' );
	include( DIR_TOOLS . 'PassHash.php' );
	session_start();

	if (isset($_GET['p'])) {
		switch ($_GET['p']) {
			case 0:
				include(DIR_CTL . 'default.php');
			break;
			
			case 1:
				include(DIR_CTL . 'user/newUser.php');
			break;

			case 2:
				include(DIR_CTL . 'user/login.php');
			break;
			
			case 99:
				include(DIR_CTL . 'user/logout.php');
			break;
			
			default:
				# code...
			break;
		}
	}
	else {
		include(DIR_CTL . 'default.php');
	}



?>
	
