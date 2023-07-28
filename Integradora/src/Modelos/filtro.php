<?php
namespace src\Modelos;
use src\Config\Conexion;
require __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;

class Filtro {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function obtenerCategorias() {
        try {
            $query = "SELECT * FROM categorias";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de error
        }
        return array();
    }
}

?>
