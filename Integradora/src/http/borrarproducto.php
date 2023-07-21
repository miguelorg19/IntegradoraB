<?php 
require_once '../../src/modelos/consultasproductos.php';
use Src\Config\Productos;
$cons = new Productos(); 
$id_producto = $_POST['id_producto'];


$cons -> borrar($id_producto);
header("Location: ../../public/views/productos.php");
exit();