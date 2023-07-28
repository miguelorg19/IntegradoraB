<?php


require '../../src/Config/conexion.php';
use src\Config\Conexion;
$db = new Conexion();
$con = $db->conectar();


session_start();

if(!isset($_SESSION['NOMBRE_USUARIO'])){

}
else{
  header("location:login.php");
}
if (isset($_SESSION['ID_USUARIO'])) {
  $idUsuario = $_SESSION['ID_USUARIO'];
}
else{
  header("location:login.php");
}


if(isset($_POST['total']) && isset($_POST['action'])){

    if(isset($_SESSION['carrito']['productos'])){

        $action = $_POST['action'];

        if($action == 'confirmado'){
            
            $total = number_format($_POST['total'],2,'.',',');

            $productos = $_SESSION['carrito']['productos'];
            $ID_USUARIO = $_SESSION['ID_USUARIO'];
            $ID_ORDENVENTA = 0;
            $ID_DETALLEORDENVENTA = 0;

                    $sql = $con->prepare("SELECT MAX(Id_Orden_Venta) as ID FROM orden_ventas");
                    $sql->execute();
            
                    $res = $sql->fetchALL(PDO::FETCH_ASSOC);

                    foreach($res as $row){
                        $ID_ORDENVENTA = $row['ID'];
                        if($ID_ORDENVENTA == 0){
                            $ID_ORDENVENTA=1;
                        }
                    }

                

                    $sql = $con->prepare("SELECT Id_Orden_Venta FROM orden_ventas WHERE Id_Orden_Venta = ?");
                    $sql->execute([$ID_ORDENVENTA]);
            
                    $res = $sql->rowCount();

                    if($res>0){
                        $ID_ORDENVENTA++;
                    }

                    


                    $sql = $con->prepare("INSERT INTO orden_ventas VALUES(:id,NOW(),:tot,'','PENDIENTE',:id_us,'')");
                    $sql->execute(array("id"=>$ID_ORDENVENTA,"tot"=>$total,"id_us"=>$ID_USUARIO));
            
                foreach($productos as $clave => $cantidad){

                    $sql = $con->prepare("SELECT MAX(Id_Detalle_orden_Venta) as ID FROM detalle_de_orden_de_ventas");
                    $sql->execute();
            
                    $res = $sql->fetchALL(PDO::FETCH_ASSOC);
    
                    foreach($res as $row){
                        $ID_DETALLEORDENVENTA = $row['ID'];
                        if($ID_DETALLEORDENVENTA == 0){
                            $ID_DETALLEORDENVENTA=1;
                        }
                    }
    
                    
    
                        $sql = $con->prepare("SELECT Id_Detalle_orden_Venta FROM detalle_de_orden_de_ventas WHERE Id_Detalle_orden_Venta = ?");
                        $sql->execute([$ID_DETALLEORDENVENTA]);
                
                        $res = $sql->rowCount();
    
                        if($res>0){
                            $ID_DETALLEORDENVENTA++;
                        }
            
                    $sql = $con->prepare("INSERT INTO detalle_de_orden_de_ventas VALUES(:id_det,:cantidad,:producto,:id)");
                    $sql->execute(array("id_det"=>$ID_DETALLEORDENVENTA,"cantidad"=>$cantidad,"producto"=>$clave,"id"=>$ID_ORDENVENTA));
                }

            unset($_SESSION['carrito']['productos']);
            $datos['ok'] = true;
    }
    else{
        $datos['ok'] = false;
    }
  }
  else{
    $datos['ok'] = false;
  }
}
else{
    $datos['ok'] = false;
    header('location:catalogo.php');
}
echo json_encode($datos);
?>
