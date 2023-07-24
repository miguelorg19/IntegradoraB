<?php
namespace Src\Config; 
require_once __DIR__ . '/../Config/Conexion.php';
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
            $query = $conexion->prepare('SELECT p.Nombre as Prod, p.Descripcion, Marca, Color FROM productos AS p
                INNER JOIN categorias AS ct ON p.CATEGORIAS_ID_CATEGORIAS = ct.ID_CATEGORIAS inner join detalle_productos on ID_productos = producto_ID_producto WHERE ct.Nombre = ?');
            $query->execute([$cat]);
            return $query;
        } catch (PDOException $e) {
            echo 'Fallo la conexion' . $e->getMessage();
        } finally {
            $this->conexion = null;
        }
    }
    public function insertarcompras(){


    }
}