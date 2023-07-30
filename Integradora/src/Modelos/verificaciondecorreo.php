<?php
require '../../src/Config/conexion.php';
use src\Config\Conexion;
$db = new Conexion();
$con = $db->conectar();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $codigoVerificacion = ""; 
    for ($i = 1; $i <= 6; $i++) {
        if (isset($_POST["codigo"][$i])) {
           
            $codigoVerificacion .= $_POST["codigo"][$i];
        } else {
            
        
        }
    }
}


if(isset($_POST['correo']) && isset($codigoVerificacion)){

    $correcto = false;

    $correo = $_POST['correo'];
    
    $query = $con->prepare("SELECT * FROM usuarios WHERE Correo = :correo LIMIT 1");
    
    $query->execute(array(":correo"=>$correo));
    
    $reg = $query->fetchALL(PDO::FETCH_ASSOC);

    $codigoUsuario;
    
    foreach($reg as $row){
        $codigoUsuario = $row['Cd_Verificacion'];
    }

    if($codigoUsuario == $codigoVerificacion){
        $correcto = true;
    }
    else{
        $correcto = false;
    }

    if($correcto){
        $query = $con->prepare("UPDATE usuarios set Estado = 'ACTIVO' WHERE correo = :correo");
    
        $query->execute(array(":correo"=>$correo));

        header("location: ../../public/views/papemaxinicio.php");
    }
    else{ 
        //header("location: ../../public/views/verificacion.php?correo=".$correo);

header("location: ../../public/views/codigoincorrecto.php?correo=".$correo);

    }
    }
    ?>
    