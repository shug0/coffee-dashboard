<?php 

	/*
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
	*/


	include( VIEW_HEADER );


	$_SESSION['session']->logout();

	include( VIEW_FOOTER );

?>
