<?php 

	define('DIR_CONFIG','C:/wamp/www/coffee-dashboard/core/');
	include_once(DIR_CONFIG . 'config.php');
	include_once(DIR_TOOLS . 'PassHash.php' );

	function __autoload($class_name) { include DIR_MDL . $class_name . '.php'; }

	session_start();

	include( VIEW_HEADER );

	if (isset($_SESSION['session'])) {
		if ($_SESSION['session']->is_logged()) {
			header('Location: dashboard.php');
		}
		else {
			header('Location: http://thatsthefinger.com/');
		}
	}
	else {
		include_once(DIR_CTL . 'user/login.php');
	}

	include( VIEW_FOOTER );

?>
	
