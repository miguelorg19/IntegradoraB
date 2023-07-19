<?php
use PDO;
use PDOexceptions;

function conectar()
{
    $bd = 'mysql:host=localhost; dbname=papemax';
    $usuario = 'root';
    $contraseña = '';
    

    try{
        $gbd = new PDO($this->$bd, $this->$usuario,$this->$contraseña);
        echo 'Conexion valida';
    }catch(PDOException $e){
        echo 'Fallo la conexion'. $e->getmessage();
    }

}