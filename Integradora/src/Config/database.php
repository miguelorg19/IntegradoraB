<?php

class Conexion{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "papemaxp";
    private $PDOConect; 


    public function conectar(){
        try{
            $conectionString = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8";
            $this->PDOConect = new PDO($conectionString,$this->user,$this->password);
       
            $this->PDOConect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
         
            return $this->PDOConect;
        }
        catch(PDOException $e){
            echo "Falló La Conexión: " . $e->getMessage();
        }
    }

   

    
}


?>