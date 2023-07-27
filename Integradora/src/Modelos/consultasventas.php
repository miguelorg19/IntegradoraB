<?php
namespace Src\Config; 
require_once __DIR__ . '/../Config/Conexion.php';
use PDO;
use PDOException;
class Ventas{
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
                INNER JOIN categorias AS ct ON p.CATEGORIAS_ID_CATEGORIAS = ct.ID_CATEGORIAS inner join detalle_productos on ID_productos = producto_ID_producto WHERE ct.Nombre = ? and Existencias > 0');
            $query->execute([$cat]);
            return $query;
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
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
    public function calculartot($id) {
        try {
            $conexion = $this->conexion->conectar();
            $query = $conexion->prepare('SELECT Precio_de_venta FROM productos WHERE ID_productos = ?');
            $query->execute([$id]);
            $precio = $query->fetch(PDO::FETCH_ASSOC);

            if ($precio && isset($precio['Precio_de_venta'])) {
                $costo = $precio['Precio_de_venta'];
                return $costo;
            }
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
            return 0; // Retorna 0 en caso de error
        } finally {
            $this->conexion = null;
        } 
    }
    public function ordenventa(){
        $IDOV = 0;
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare('SELECT MAX(Id_Orden_Venta) as ID FROM orden_ventas');
        $cons->execute();
        $res = $cons->fetchall(PDO::FETCH_ASSOC);
        foreach($res as $ov)
        {
            $IDOV = $ov['ID'];
                        if($IDOV == 0){
                            $IDOV=1;
                        }
        }
        $sql = $conexion->prepare("SELECT Id_Orden_Venta FROM orden_ventas WHERE Id_Orden_Venta = ?");
        $sql->execute([$IDOV]);
        $res = $sql->rowCount();
        if($res>0){
            $IDOV++;
        }
        $sql = $conexion->prepare("INSERT INTO orden_ventas VALUES(?,NOW(),0,'','REALIZADO',1,'')");
        $sql->execute([$IDOV]);
        return $IDOV;
    }
    public function insertarventas($Ov)
    {
        try {
            $conexion = $this->conexion->conectar();
            if (isset($_SESSION['Ventas'])) {
                foreach ($_SESSION['Ventas'] as $venta) {
                    $cant = $venta['cantidad'];
                    $productosID = $venta['productoID'];
                    $query = $conexion->prepare('INSERT INTO detalle_de_orden_de_ventas (Cantidad, Productos_ID_Productos, Orden_Ventas_Id_Orden_Venta) VALUES (?, ?, ?)');
                    $query->execute([$cant, $productosID, $Ov]);
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
    public function avisos(){
        echo '<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 bg-danger bg-opacity-50 d-flex justify-content-center mt-3" style="border-radius: 10px; margin:0 auto;">
        <h5 class="msj mt-2">Debe llenar todos los campos</h5></div>';
    }
}

session_start();
$cons = new Ventas();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['agregar'])) {
    $productoId = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    if(empty($productoId) || empty($cantidad))
    {
        $_SESSION['resultado'] = true;
        header('location: ../../public/views/registroventas.php');
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
    $_SESSION['Ventas'][]= array(
        'productoID' => $productoId,
        'cantidad' => $cantidad,
        'nombre' => $nombreProducto,
        'fecha' => $fecha,
        'totalven' =>$totalven,
        'total' => $total,
    );
    }
    header('Location: ../../public/views/registroventas.php');
    exit;
}
else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirmar']))
{
    if (isset($_SESSION['Ventas'])) {
        $Orden = $cons -> ordenventa();
        echo $Orden;
        $cons->insertarventas($Orden);  
    }
    else
    {  
    }
    session_unset();
    header('Location: ../../public/views/registroventas.php');
    exit;
}
else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cancelar']))
{
    session_unset();
    header('Location: ../../public/views/registroventas.php');
    exit;
}