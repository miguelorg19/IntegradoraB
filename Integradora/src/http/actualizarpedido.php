<?php 
require_once '../../src/Modelos/consultaspedidos.php';
use src\Config\Pedidos;
$cons = new Pedidos(); 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['realizar'])) {
$id = $_POST['id_venta']; 
$nuevoEstado = "REALIZADO";
$cons->actualizarEstadoPedido($id, $nuevoEstado);
header("location: ../../public/views/pedidos.php");
exit();
}
else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cancelar'])) {
    $id = $_POST['id_venta']; 
    $nuevoEstado = "CANCELADO";
    $cons->actualizarEstadoPedido($id, $nuevoEstado);
    header("location: ../../public/views/pedidos.php");
    exit();
}