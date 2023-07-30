<?php

require_once '../../src/Config/conexion.php';
use Src\Config\Conexion;

session_start();

if(!isset($_SESSION['usuario_id'])){
    header("location:login.php");
}



if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($action == 'agregar'){
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id,$cantidad);
        if($respuesta > 0){
            $datos['ok'] = true;
        }
        else{
            $datos['ok'] = false;
        }
        $datos['sub'] = $respuesta;
    }
    else if($action == 'eliminar'){
        $datos['ok'] = eliminar($id);
    }else{
        $datos['ok'] = false;
    }
}else{
    $datos['ok'] = false;
}



function agregar($id, $cantidad){
    $res = 0;
    if($id >0 && $cantidad > 0 && is_numeric(($cantidad))){
        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            
            $db = new Conexion();
            $con = $db->conectar();

            $sql = $con->prepare("SELECT Precio_de_Venta FROM productos WHERE ID_Productos = :id");
            $sql->execute(array('id'=>$id));
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($resultado as $row){
            $precio = $row['Precio_de_Venta'];
            $res = $precio * $cantidad;
            return $res;
            }
        }
        return $res;
    }
}

function eliminar($id){
    if(isset($_SESSION['carrito']['productos'][$id])){
        unset($_SESSION['carrito']['productos'][$id]);
    
        return true;
    }
     else{
        return false;
    }
}
 
echo json_encode($datos);

?>
