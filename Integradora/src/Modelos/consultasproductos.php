<?php
namespace Src\Config;

require_once __DIR__ . '/../config/conexion.php';

class Productos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function todos()
    {
        $conexion = $this->conexion->conectar();
        $query = $conexion->query('SELECT p.ID_Productos, p.Nombre AS Prod, p.Descripcion, p.Existencias, p.Precio_de_Venta, ct.Nombre AS Cat
        FROM PRODUCTOS AS p
        INNER JOIN CATEGORIAS AS ct ON p.CATEGORIAS_ID_CATEGORIAS = ct.ID_CATEGORIAS');
        $productos = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $productos;
    }
    public function actualizar($nombre, $preciodeventa,$categoria, $id)
    {   
        $conexion = $this->conexion->conectar();
        $act = $conexion->prepare('UPDATE PRODUCTOS SET NOMBRE = ?, PRECIO_DE_VENTA = ?, CATEGORIAS_ID_CATEGORIAS = ? WHERE ID_PRODUCTOS = ?');
        $act->execute([$nombre, $preciodeventa,$categoria,$id]);
    }
    public function borrar($id)
    {
        $conexion = $this->conexion->conectar();
        $del = $conexion->prepare('DELETE FROM PRODUCTOS WHERE ID_PRODUCTOS = ?');
        $del->execute([$id]);
    }
}