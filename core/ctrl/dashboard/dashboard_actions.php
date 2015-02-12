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
					$cityInDb = $db->getRow('SELECT option_value FROM options WHERE option_name=city');
		
					// Si n'est pas présent en DB -> AJOUT
					if (empty($cityInDb)) {
						if ($db->insertRow(
							'INSERT INTO options (option_name, option_value) 
							 VALUES (:name,:value)',
							 array(
							 	':name' => 'city',
							 	':value' => $newCity 
							 ))) 
				 		{
				 			echo "La ville à été enregistré";
				 		}
				 		else {
							echo "Erreur lors de l'ajout";
				 		}
					}
					// PRESENT EN DB -> UPDATE
					else {
						// Si la nouvelle ville n'est pas la même
						if ($cityInDb == $newCity ) {
							echo "La ville est la même";
						}
						else {
							$db->updateRow(
								'UPDATE options 
								 SET option_value = :value
								 WHERE option_name = :name',
								 array(
								 	':name' => 'city',
								 	':value' => $newCity 
								)
							);
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