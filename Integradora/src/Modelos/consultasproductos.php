<?php
namespace Src\Config;

require_once __DIR__ . '/../Config/conexion.php';
use PDO;
use PDOException;

class Productos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function todos()
    {
        try{
        $conexion = $this->conexion->conectar();
        $query = $conexion->query("SELECT p.ID_Productos, p.Nombre AS Prod, p.Descripcion, p.Existencias, p.Precio_de_Venta, i.Imagen, p.ESTADO, ct.Nombre AS Cat
        FROM productos AS p
        INNER JOIN categorias AS ct ON p.CATEGORIAS_ID_CATEGORIAS = ct.ID_CATEGORIAS inner join imagenes i on ID_Productos = producto_ID_Producto WHERE p.ESTADO = 'ACTIVO' order by p.ID_PRODUCTOS ASC");
        $productos = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $productos;
        }
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }finally{
            $this->conexion = null;
        }
    }
    public function actualizar($nombre, $preciodeventa,$categoria, $id)
    {   
        try{
        $conexion = $this->conexion->conectar();
        $act = $conexion->prepare('UPDATE productos SET NOMBRE = ?, PRECIO_DE_VENTA = ?, CATEGORIAS_ID_CATEGORIAS = ? WHERE ID_PRODUCTOS = ?');
        $act->execute([$nombre, $preciodeventa,$categoria,$id]);
        }
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }finally{
            $this->conexion = null;
        }
    }
    public function borrar($id)
    {
        try{
        $conexion = $this->conexion->conectar();
        $del = $conexion->prepare("UPDATE productos SET ESTADO = 'BAJA' WHERE ID_PRODUCTOS = ?");
        $del->execute([$id]);
        }
                catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }finally{
            $this->conexion = null;
        }
    }
    public function cat($cat)
    {
        $conexion = $this ->conexion->conectar();
        $cards = $conexion->prepare("SELECT ID_Productos,Nombre,Precio_de_Venta as 'Precio',Imagen from productos inner join imagenes on ID_Productos = producto_ID_producto WHERE CATEGORIAS_ID_CATEGORIAS = ? LIMIT 4");
        $cards->execute([$cat]);
        return $cards;
    }
}