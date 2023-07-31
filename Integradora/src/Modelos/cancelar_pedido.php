<?php
require_once '../../src/Config/conexion.php';
use Src\Config\Conexion;

if(isset($_POST['folio'])){
    $folio = $_POST['folio'];

    $db = new Conexion();
    $con = $db->conectar();

    $sql = $con->prepare("UPDATE orden_ventas set Estatus = 'CANCELADO' WHERE Folio = :folio");
    $sql->execute(array('folio'=>$folio));
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    $datos['ok']=true;

}
else{
    $datos['ok']=false;
}


echo json_encode($datos);



?>