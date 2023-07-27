<?php 
require_once '../../src/Modelos/consultasproductos.php';
use src\Config\Productos;
$cons = new Productos(); 
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];

$cons -> actualizar($nombre, $precio, $categoria,$id_producto);
header("Location: ../../public/views/productos.php");
exit();