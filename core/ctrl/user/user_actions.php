<?php 

header("Access-Control-Allow-Origin: *"); 

define('DIR_CONFIG','C:/wamp/www/coffee-dashboard/core/');

require( DIR_CONFIG . 'config.php');
include( DIR_TOOLS . 'PassHash.php' );

function __autoload($class_name) { include DIR_MDL . $class_name . '.php'; }

session_start();

$db = new Database();

if ($db->isConnected) 
{

	if (isset($_POST['action'])) {

		switch ($_POST['action']) {


			// ------------- AJAX FOR USER/LOGIN.PHP ------------- //

			case 'login':
				
				if( isset($_POST['pseudo']) && isset($_POST['password']) ){	

			    	$result = $db->getRow('SELECT user_pass FROM users WHERE user_login = :pseudo', array(':pseudo' => $_POST['pseudo']));

			        if(!empty($result)) 
			        {
			        	if (PassHash::check_password($result['user_pass'], $_POST['password'])) 
			        	{
			                $_SESSION['session'] = new Session($_POST['pseudo'], $_POST['password']);
			        		$db->Disconnect();
			                echo "Success";
			        	}
			        	//else { $db->Disconnect(); echo "badPassword";  }
			        }
			        elseif (empty($_POST['pseudo']) && empty($_POST['password'])) { $db->Disconnect(); echo "allEmpty"; }
			        elseif (empty($_POST['pseudo']) AND !empty($_POST['password'])) { $db->Disconnect(); echo "pseudoEmpty"; }
			        elseif (!empty($_POST['pseudo']) AND empty($_POST['password'])) { $db->Disconnect(); echo "passwordEmpty"; }
			        //else { $db->Disconnect(); echo "badPseudo"; }
			    }
				break;
			

			// ------------- AJAX FOR USER/NEWUSER.PHP ------------- //

			case 'newUser':
				
				if( isset($_POST['pseudo']) && isset($_POST['password']) )
			    {	
			    	if (empty($_POST['pseudo']) AND empty($_POST['password'])) { echo "allEmpty"; $db->Disconnect(); }
			    	elseif (!empty($_POST['pseudo']) AND empty($_POST['password'])) { echo "passwordEmpty"; $db->Disconnect(); }
			   		elseif (empty($_POST['pseudo']) AND !empty($_POST['password'])) { echo "pseudoEmpty"; $db->Disconnect(); }
			        else {
			            
			            $newUser = new User($db, $_POST['pseudo'], $_POST['password']);
			            echo $newUser->createDbUser() ? "Success" : "userAlreadyExist";
			            
			            $db->Disconnect();
			        }
				}
				break;

			// Defaut break

			default:
			    $db->Disconnect();
	    		echo "badDatabase";
			break;
		}
	}
}
else { $db->Disconnect(); echo "badDatabase"; }
