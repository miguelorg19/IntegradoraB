<?php

session_start();

if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}

if(isset($_POST['id']) || isset($_POST['cantidad'])){

    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    if(isset($_SESSION['carrito']['productos'][$id])){
        $_SESSION['carrito']['productos'][$id] += $cantidad;
        $datos['existe'] = true;
    }else{
        $_SESSION['carrito']['productos'][$id] = $cantidad;
        $datos['existe'] = false;
    }

    $datos['numero'] = count($_SESSION['carrito']['productos']);
    $datos['ok'] = true;

}else{
    $datos['ok'] = false;
}

echo json_encode($datos);


?>

