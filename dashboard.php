<?php 

	define('DIR_CONFIG', __DIR__ . '/core/');
	include_once(DIR_CONFIG . 'config.php');
	include_once(DIR_TOOLS . 'PassHash.php' );

	function __autoload($class_name) { include_once DIR_MDL . $class_name . '.php'; }
	session_start();

	include_once( VIEW_HEADER );

	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{
		if (isset($_GET['p'])) {  
			switch ($_GET['p']) {

				case 'dashboard':
					$pageToLoad = (DIR_CTL . 'dashboard/dashboard.php');
					break;
				case 'users':
					$pageToLoad = (DIR_CTL . 'user/manage.php');
					break;
				case 'settings':
					$pageToLoad = (DIR_CTL . 'settings/settings.php');
					break;
				default:
					$pageToLoad = (DIR_CTL . 'dashboard/dashboard.php');
					break;
			}
		}	
		else { $pageToLoad = (DIR_CTL . 'dashboard/dashboard.php');	}

		include_once($pageToLoad);

	}} // END SECURED AREA
	else {
		header('Location: ' . URL_WEB . 'index.php');
	}

	include_once( VIEW_FOOTER );

?>
	





