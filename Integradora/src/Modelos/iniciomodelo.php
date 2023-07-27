<?php
namespace src\Modelos;

use src\Config\Conexion;
require_once '../../src/Config/conexion.php';
use PDO;
use PDOException;

class Inciomodelo
{
    public function obtenerPrimerProductoAleatorio()
    {
        $conexion = new Conexion();
        $gbd = $conexion->conectar();

        try {
            $consulta = "SELECT * FROM productos ORDER BY RAND() LIMIT 1";
            $statement = $gbd->query($consulta);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error al obtener el primer producto aleatorio: ' . $e->getMessage();
            return null;
        }
    }

    
    public function obtenerImagenAleatoriaPorProducto($productoID)
    {
        $conexion = new Conexion();
        $gbd = $conexion->conectar();
    
        try {
          
            $consulta = "SELECT Imagen FROM imagenes WHERE producto_ID_Producto = :productoID ORDER BY RAND() LIMIT 1";
            $statement = $gbd->prepare($consulta);
            $statement->bindParam(':productoID', $productoID, PDO::PARAM_INT);
            $statement->execute();
    
            $imagen = $statement->fetchColumn();
       
            return $imagen ? '../../public/Productos/' . $imagen : '../imagenes/imagen_por_defecto.jpg'; 
        } catch (PDOException $e) {
            echo 'Error al obtener imagen aleatoria para el producto: ' . $e->getMessage();
            return '../imagenes/imagen_por_defecto.jpg'; 
        }
    }

    public function obtenerImagenesAleatorias($cantidad = 5)
{
    $conexion = new Conexion();
    $gbd = $conexion->conectar();

    try {
       
        $consulta = "SELECT i.Imagen
                     FROM imagenes i
                     JOIN productos p ON i.producto_ID_Producto = p.ID_Productos
                     ORDER BY RAND()
                     LIMIT :cantidad";

        
        $statement = $gbd->prepare($consulta);
        $statement->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $statement->execute();

   
        $nombresArchivos = $statement->fetchAll(PDO::FETCH_COLUMN);

        
        $rutaBase = '../../public/Productos/';
        $rutasImagenes = array_map(function ($nombreArchivo) use ($rutaBase) {
            return $rutaBase . $nombreArchivo;
        }, $nombresArchivos);

    
        return $rutasImagenes;
    } catch (PDOException $e) {
        echo 'Error al obtener imágenes: ' . $e->getMessage();
        return [];
    }
}
}
?>
