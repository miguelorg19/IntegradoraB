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
    public function nuevoprod($Nombre,$Descripcion,$Existencias,$Precio_De_Venta,$Costo, $Categoria){
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
        $sql->execute([$IDP,$Nombre,$Descripcion,$Existencias,$Precio_De_Venta,$Categoria,$Costo]);
        return $IDP;
    }
    
    public function newimg($idpr,$nombre)
    {
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare("INSERT INTO imagenes(Imagen, producto_ID_Producto) VALUES(?,?)");
        $cons->execute([$nombre, $idpr]);
    }
    public function detalles($idpr,$marca, $cantidapac,$tamaño, $color)
    {
        $conexion = $this->conexion->conectar();
        $cons = $conexion->prepare("INSERT INTO detalle_productos(Marca, Cantidad, Tamaño, Color, producto_ID_Producto)  VALUES(?,?,?,?,?)");
        $cons->execute([$marca,$cantidapac,$tamaño,$color,$idpr]);
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
        $sql = $conexion->prepare("SELECT Id_Orden_Compra FROM orden_de_compras WHERE Id_Orden_Compra = ?");
        $sql->execute([$IDOC]);
        $res = $sql->rowCount();
        if($res>0){
            $IDOC++;
        }
        $sql = $conexion->prepare("INSERT INTO orden_de_compras VALUES(?,NOW(),0)");
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
        $_SESSION['com'] = true;
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
        'costo' => $preciocon
        );
    header('location: ../../public/views/registrocompras.php');
    exit();
    }

}
else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirmar'])) {
    if (isset($_SESSION['Compras'])) {
        $Orden = $cons -> ordencompra();
        echo $Orden;
        $cons->insertarcompras($Orden);  
    }
    else
    {  
    }
    unset($_SESSION['Compras']);
    unset($_SESSION['Total']);
    header('Location: ../../public/views/registrocompras.php');
    exit;
}
else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['guardar'])){
    $nombre = $_POST['nombre'];
    $costo = $_POST['costo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $desc = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $tamaño = $_POST['tamaño'];
    $color = $_POST['color'];
    $cant = $_POST['cantidadpaq'];
    $cate = $_POST['categoria'];
    $img = $_FILES['img'];
    if (empty($nombre) || empty($costo) || empty($precio) || empty($cantidad) || empty($marca) || empty($cant) || empty($cate) || empty($img)) {
        $_SESSION['vacio'] = true;
        header('location: ../../public/views/registrocompras.php');
    } else if (!is_numeric($costo) || !is_numeric($precio) || !is_numeric($cantidad) || !is_numeric($cant)) {
        $_SESSION['numeros'] = true;
        header('location: ../../public/views/registrocompras.php');
    }    
    else{
            $IDNP = $cons->nuevoprod($nombre,$desc,$cantidad,$precio,$costo,$cate);
            $directorio = '../../public/Productos/';
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $nuevonombre = 'producto_'.$IDNP.'.'.$extension;
            $rutaimagen = $directorio . $nuevonombre;
            if (move_uploaded_file($img['tmp_name'], $rutaimagen)) {
               echo "Imagen Subida";
            } else {
            }
            $cons ->newimg($IDNP, $nuevonombre);
            $cons -> detalles($IDNP, $marca, $cant, $tamaño, $color);

            $nombreProducto = $nombre;
            $fecha = date("Y-m-d");
            $preciocon = $cons->calculartot($IDNP);
             $totalven =  $preciocon * $cantidad;
            if (isset($_SESSION['total'])) {
            $total = $_SESSION['total'];
            } else {
            $total = 0;
            }
            $total += $totalven;

        $_SESSION['total'] = $total;
        $_SESSION['Compras'][]= array(
        'productoID' => $IDNP,
        'cantidad' => $cantidad,
        'nombre' => $nombreProducto,
        'fecha' => $fecha,
        'totalven' =>$totalven,
        'total' => $total,
        'costo' => $preciocon
        );
        header('Location: ../../public/views/registrocompras.php');
        exit;
    }
    }
