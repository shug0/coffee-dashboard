<?php 


	$the_title = 'Gestion des Utilisateurs';
	$simple_title =  strtolower($the_title);  
	echo('<script>$("title").html("'. $the_title .'")</script>');


	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{

		
		$db = new Database();
		if ($db->isConnected) 
		{
			$users = $db->getRows('SELECT ID, user_login, user_mail, user_firstname, user_lastname FROM `users`');
			include_once(DIR_VIEW . 'user/manage.php');
		}


	}} // END SECURED AREA






 ?>