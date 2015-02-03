<?php 

if (isset($_SESSION['session'])) 
{
	$_SESSION['session']->logout(); 
	header('Location: index.php');      
}
else 
{
	header('Location: index.php');      
} 

?>

