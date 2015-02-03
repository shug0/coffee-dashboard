<?php 


	$the_title = 'Gestion des Utilisateurs';
	$simple_title =  strtolower($the_title);  
	echo('<script>$("title").html("'. $the_title .'")</script>');


	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{
		
		include_once(DIR_VIEW . 'user/manage.php');

	}} // END SECURED AREA






 ?>