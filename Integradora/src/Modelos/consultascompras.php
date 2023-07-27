<?php 
namespace Src\Config; 
require_once __DIR__ . '/../Config/Conexion.php';
use PDO;
use PDOException;
class Compras{
    private $conexion;
    
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function consultarprod($cat)
    {
        try {
            $conexion = $this->conexion->conectar();
            $query = $conexion->prepare('SELECT p.ID_productos, p.Nombre as Prod,p.Existencias, p.Descripcion, Marca, Color, p.Precio_de_Venta FROM productos AS p
                INNER JOIN categorias AS ct ON p.CATEGORIAS_ID_CATEGORIAS = ct.ID_CATEGORIAS inner join detalle_productos on ID_productos = producto_ID_producto WHERE ct.Nombre = ?');
            $query->execute([$cat]);
            return $query;
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
        } 
    }
    public function calculartot($id) {
        try {
            $conexion = $this->conexion->conectar();
            $query = $conexion->prepare('SELECT Costo FROM productos WHERE ID_productos = ?');
            $query->execute([$id]);
            $precio = $query->fetch(PDO::FETCH_ASSOC);

            if ($precio && isset($precio['Costo'])) {
                $costo = $precio['Costo'];
                return $costo;
            }
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
            return 0; // Retorna 0 en caso de error
        } finally {
            $this->conexion = null;
        } 
    }
    public function producto($id) {
        try {
            $conexion = $this->conexion->conectar();
            $query = $conexion->prepare('SELECT Nombre FROM productos WHERE ID_productos = ?');
            $query->execute([$id]);
            $nombreProducto = $query->fetch(PDO::FETCH_ASSOC);
            if ($nombreProducto && isset($nombreProducto['Nombre'])) {
                return $nombreProducto['Nombre'];
            } 
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
            return '';
        }
    }
    public function nuevoprod($Nombre,$Descripcion,$Existencias,$Precio_De_Venta,$Costo){
        $IDP = 0;
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare('SELECT MAX(ID_productos) as ID FROM productos');
        $cons->execute();
        $res = $cons->fetchall(PDO::FETCH_ASSOC);
        foreach($res as $ov)
        {
            $IDP = $ov['ID'];
                        if($IDP == 0){
                            $IDP=1;
                        }
        }
        $sql = $conexion->prepare("SELECT ID_productos FROM productos WHERE ID_productos = ?");
        $sql->execute([$IDP]);
        $res = $sql->rowCount();
        if($res>0){
            $IDP++;
        }
        $sql = $conexion->prepare("INSERT INTO productos VALUES(?,?,?,?,?,'',?,'',?,'ACTIVO')");
        $sql->execute([$IDP,$Nombre,$Descripcion,$Existencias,$Precio_De_Venta,$Costo]);
        return $IDOC;
    }
    
    public function newimg($idpr,$nombre)
    {
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare("INSERT INTO imagenes VALUES(?,'',?)");
        $cons = execute([$nombre, $idpr]);
    }
    public function detalles($idpr,$marca, $cantidapac,$tamaño, $color)
    {
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare("INSERT INTO detalle_productos VALUES(?,?,?,?,?)");
        $cons = execute([$marca,$cantidapac,$tamaño,$color,$idpr]);
    }
    public function ordencompra(){
        $IDOC = 0;
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare('SELECT MAX(Id_Orden_Compra) as ID FROM orden_de_compras');
        $cons->execute();
        $res = $cons->fetchall(PDO::FETCH_ASSOC);
        foreach($res as $ov)
        {
            $IDOC = $ov['ID'];
                        if($IDOC == 0){
                            $IDOC=1;
                        }
        }
        $sql = $conexion->prepare("SELECT Id_Orden_Venta FROM orden_ventas WHERE Id_Orden_Venta = ?");
        $sql->execute([$IDOC]);
        $res = $sql->rowCount();
        if($res>0){
            $IDOC++;
        }
        $sql = $conexion->prepare("INSERT INTO orden_ventas VALUES(?,NOW(),0,'','REALIZADO',1,'')");
        $sql->execute([$IDOC]);
        return $IDOC;
    }
    public function insertarcompras($Oc)
    {
        try {
            $conexion = $this->conexion->conectar();
            if (isset($_SESSION['Compras'])) {
                foreach ($_SESSION['Compras'] as $compra) {
                    $cant = $compra['cantidad'];
                    $productosID = $compra['productoID'];
                    $costo = $compra['costo'];
                    $query = $conexion->prepare('INSERT INTO detalle_orden_compras (Cantidad, Orden_De_Compras_Id_Orden_Compra, producto_ID_Producto, costo) VALUES (?, ?, ?, ?)');
                    $query->execute([$cant, $Oc, $productosID,$costo]);
                }
                $conexion->commit();
            }

        } catch (PDOException $e) {
            echo 'Fallo la conexión' . $e->getMessage();
            return 0;
        } finally {
            $this->conexion = null;
        }
    }
}
session_start();
$cons = new Compras();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['agregar'])) {
    $productoId = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    if(empty($productoId) || empty($cantidad))
    {
        $_SESSION['resultado'] = true;
        header('location: ../../public/views/registrocompras.php');
        exit;
    }
    else{
    $_SESSION['resultado'] = false;
    $nombreProducto = $cons->producto($productoId);
    $fecha = date("Y-m-d");
    $preciocon = $cons->calculartot($productoId);
    $totalven =  $preciocon * $cantidad;
    if (isset($_SESSION['total'])) {
        $total = $_SESSION['total'];
    } else {
        $total = 0;
    }
    $total += $totalven;

    $_SESSION['total'] = $total;
    $_SESSION['Compras'][]= array(
        'productoID' => $productoId,
        'cantidad' => $cantidad,
        'nombre' => $nombreProducto,
        'fecha' => $fecha,
        'totalven' =>$totalven,
        'total' => $total,
    );
    session_unset();
    header('location: ../../public/views/registrocompras.php');
    exit();
    }

}