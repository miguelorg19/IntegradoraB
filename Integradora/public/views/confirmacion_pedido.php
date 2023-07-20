<?php

require '../../src/Config/database.php';
$db = new Conexion();
$con = $db->conectar();


session_start();


if(!isset($_SESSION["Nombre"])){

    header("location:../Login/index.php");
  
}

if(isset($_POST['total']) && isset($_POST['action'])){

    $action = $_POST['action'];
    if($action == 'confirmado'){
    
    $productos = $_SESSION['carrito']['productos'];
    $ID_USUARIO = $_SESSION['ID_USUARIO'];

   
        $sql = $con->prepare("INSERT INTO orden_ventas VALUES(7,NOW(),'','','PENDIENTE',?)");
        $sql->execute([$ID_USUARIO]);

    foreach($productos as $clave => $cantidad){

        $sql = $con->prepare("INSERT INTO detalle_de_orden_de_ventas VALUES('',:cantidad,:producto,7)");
        $sql->execute(array("cantidad"=>$cantidad,"producto"=>$clave));
    }

    unset($_SESSION['carrito']['productos']);
    $datos['ok'] = true;
    }
}
else{
    $datos['ok'] = false;
    header('location:catalogo.php');
}


echo json_encode($datos);


?>