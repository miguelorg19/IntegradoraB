<?php
require '../../src/Config/conexion.php';
use src\Config\Conexion;


class Codigo{

    function verificar($codigoVerificacion,$correo){
        $db = new Conexion();
        $con = $db->conectar();


        $query = $con->prepare("SELECT * FROM usuarios WHERE Correo = :correo LIMIT 1");
        $query->execute(array(":correo"=>$correo));
        
        $reg = $query->fetchALL(PDO::FETCH_ASSOC);
        $codigoUsuario="";
        foreach($reg as $row){
            $codigoUsuario = $row['Cd_Verificacion'];
        }
    
        if($codigoUsuario == $codigoVerificacion){  

            $query = $con->prepare("UPDATE usuarios set Estado = 'ACTIVO' WHERE correo = :correo");
            $query->execute(array(":correo"=>$correo));

            return true;
        }
        else{
            return false;
        }
    }
}




?>