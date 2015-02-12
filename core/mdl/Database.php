<?php 

class Database {

	public $isConnected;
	protected $datab;

	public function __construct(){
	    $this->isConnected = true;
	    try { 
	        $this->datab = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME .'', DB_USER, DB_PASSWORD);	        
	        $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	        $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    } 
	    catch(PDOException $e) { 
	        $this->isConnected = false;
            echo "Erreur sur la connexion a la base :" . $e;
            throw new Exception($e->getMessage());
	    }
	}

    public function Disconnect(){
        $this->datab = null;
        $this->isConnected = false;
    }


    public function getRow($query, $params=array()){
            try{ 
                $stmt = $this->datab->prepare($query); 
                $stmt->execute($params);
                return $stmt->fetch();  
                }catch(PDOException $e){
                echo 'Erreur :' . $e;
                throw new Exception($e->getMessage());
            }
        }
    public function getRows($query, $params=array()){
        try{ 
            $stmt = $this->datab->prepare($query); 
            $stmt->execute($params);
            return $stmt->fetchAll();       
            }catch(PDOException $e){
            throw new Exception($e->getMessage());
            echo 'Erreur :' . $e;
        }       
    }
    public function insertRow($query, $params){
        try { 
            $stmt = $this->datab->prepare($query); 
            $stmt->execute($params);
            return true;
            } catch(PDOException $e) {
            throw new Exception($e->getMessage());
            return false;
        }           
    }
    public function updateRow($query, $params){
        return $this->insertRow($query, $params);
    }
    public function deleteRow($query, $params){
        return $this->insertRow($query, $params);
    }

}

 ?>