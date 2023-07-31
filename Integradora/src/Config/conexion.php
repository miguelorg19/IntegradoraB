<?php
namespace src\Config;
use PDO;
use PDOException;
class Conexion{
    function conectar()
    {
    $bd = 'mysql:host=54.87.196.147; dbname=papemaxp';
    $usuario = 'emith14';
    $contraseña = 'Emith14!';  
    $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES=>false
    ];
    try{
        $gbd = new PDO($bd, $usuario,$contraseña,$options);
        return $gbd;
    }catch(PDOException $e){
        echo 'Fallo la conexion'. $e->getmessage();
    }
    }
}