<?php 

class Session 
{
	private $pseudo;
	private $pwd;
	private $isLog;

 	public function __construct($pseudo, $pwd) 
 	{
		$db = new Database();
		$hashUserInDB = $db->getRow('SELECT password FROM USERS WHERE pseudo = :pseudo', array(':pseudo' => $pseudo));

		if (PassHash::check_password($hashUserInDB['password'], $pwd)) {

			$newHash = PassHash::hash($pwd);
			$db->updateRow(
			'UPDATE USERS 
			 SET password = :password
			 WHERE pseudo = :pseudo',
			 array(
			 	':pseudo' => $pseudo,
			 	':password' => $newHash 
			 ));

			$_SESSION['pseudo'] = $pseudo;
	        $_SESSION['hash'] = $newHash;
			$this->isLog = true; 			
		}
  		$db->Disconnect();
 	}

	public function check () 
	{
		if (isset($_SESSION['pseudo']) and isset($_SESSION['hash'])) 
		{
			$db = new Database();
			$hashUserInDB = $db->getRow('SELECT password FROM USERS WHERE pseudo = :pseudo', array(':pseudo' => $_SESSION['pseudo']));

    		if ($_SESSION['hash'] == $hashUserInDB['password'] ) 
    		{
    			return true;
    			$db->Disconnect();
    		}
    		else { return false; }
   		}
		else { return false; } 
	}

	public function isLog() 
	{  
    	return $this->isLog;
	}

	public function logout () 
	{
		session_unset ();  
		session_destroy ();  
		$this->isLog = false; 
		return true;
	}
}


 ?>