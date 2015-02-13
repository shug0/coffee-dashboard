<?php 

header("Access-Control-Allow-Origin: *"); 

define('DIR_CONFIG', dirname(dirname(__DIR__)) . "\\");
require( DIR_CONFIG . 'config.php');
include( DIR_TOOLS . 'PassHash.php' );

function __autoload($class_name) { include DIR_MDL . $class_name . '.php'; }

session_start();

$db = new Database();

if ($db->isConnected) 
{
	if (isset($_POST['action'])) {

		switch ($_POST['action']) {

			case 'city':

				if (empty($_POST['city'])) {
					echo "empty";
				}
				else {	

					$newCity = $_POST['city'];
					$cityInDb = $db->getRow('SELECT option_value FROM options WHERE option_name="city"');
					$params = array(
					 	':name' => 'city',
						':value' => $newCity 
					);

					// Si n'est pas présent en DB -> AJOUT
					if (empty($cityInDb)) {
						if ($db->insertRow(
							'INSERT INTO options (option_name, option_value) 
							 VALUES (:name,:value)', $params)) 
				 		{
				 			echo "sucess";
				 		}
					}
					// PRESENT EN DB -> UPDATE
					else {
						// Si la nouvelle ville n'est pas la même
						if ($cityInDb['option_value'] == $newCity ) {
							echo "sameCity";
						}
						else {
							$db->updateRow(
								'UPDATE options 
								 SET option_value = :value
								 WHERE option_name = :name', $params);
							echo "sucess";
						}
					}
				}
			break;
			
			default:
			    $db->Disconnect();
	    		echo "badDatabase";
			break;
		}
	}
}
else { $db->Disconnect(); echo "badDatabase"; }