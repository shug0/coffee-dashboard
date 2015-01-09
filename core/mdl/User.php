<?php 

class User 
{
	private $pseudo;
	private $pwd;
	private $db;

 	public function __construct ($db, $pseudo, $pwd) 
 	{
		$this->db = $db;

 		$this->pseudo = $pseudo;
 		$this->pwd = $pwd;
 	}

 	public function createDbUser () {
		if ($this->db->insertRow(
			'INSERT INTO USERS (pseudo, password) 
			 VALUES (:pseudo,:password)',
			 array(
			 	':pseudo' => $this->pseudo,
			 	':password' => PassHash::hash($this->pwd) 
			 ))) 
 		{
 			// Si l'utilisateur est bien ajouté
 			return true;
 		}
 		else {
 			// Il y a une erreur, donc l'utilisateur existe déjà
 			return false;
 		}
 	}

	public function getName () 
	{  
    	return $this->pseudo;
	}

	public function getPwd () 
	{  
    	return $this->pwd;
	}
}


 ?>