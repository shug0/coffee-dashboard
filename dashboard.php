<?php 

	define('DIR_CONFIG', __DIR__ . '/core/');
	include_once(DIR_CONFIG . 'config.php');
	include_once(DIR_TOOLS . 'PassHash.php' );

	function __autoload($class_name) { include DIR_MDL . $class_name . '.php'; }
	session_start();

	include( VIEW_HEADER );

	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{
		if (isset($_GET['p'])) {  
			switch ($_GET['p']) {
				case 'dashboard':
					include_once(DIR_CTL . 'dashboard/dashboard.php');
					break;
				case 'users':
					include_once(DIR_CTL . 'user/manage.php');
					break;
				case 'settings':
					include_once(DIR_CTL . 'settings/settings.php');
					break;
				default:
					include_once(DIR_CTL . 'dashboard/dashboard.php');
					break;
			}
		}	
		else {	include_once(DIR_CTL . 'dashboard/dashboard.php');	}
	}} // END SECURED AREA
	else {
		header('Location: ' . URL_WEB . 'index.php');
	}

	include( VIEW_FOOTER );

?>
	





