<?php

namespace src\Modelos;

use src\Config\Conexion;

require_once '../../src/Config/conexion.php';

use PDO;
use PDOException;

class Graficamensual
{
    private $db;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function obtenerGananciasPorMes($mesSeleccionado)
    {
        try {
            $query = "CALL GananciaPorMes(:numero_mes)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':numero_mes', $mesSeleccionado, PDO::PARAM_INT);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
        }
    }

    public function obtenerGananciasPorSemana($nombreMes)
    {
        try {
            $query = "CALL GananciaPorMes(:nombre_mes)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre_mes', $nombreMes, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
        }
    }
}
