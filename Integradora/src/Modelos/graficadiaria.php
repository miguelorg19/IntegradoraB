<?php
namespace src\Modelos;
use src\Config\Conexion;
require __DIR__ . '/../Config/conexion.php';
require __DIR__ . '/../../vendor/autoload.php';
use PDO;
use PDOException;

class Graficadiaria{
    public function obtenerGananciasPorDia($fecha_consulta)
    {
        try {
          
            $conexion = new Conexion();
            $conn = $conexion->conectar();

           
            $sql = "CALL GananciaPorDia(:fecha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha_consulta, \PDO::PARAM_STR);
            $stmt->execute();

           
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $conn = null; // Cerrar la conexión

           
            $labels = array_column($resultados, 'Fecha');
            $ganancias = array_column($resultados, 'Ganancias');
            $costos = array_column($resultados, 'Costos');
            $gananciaPerdidaTotal = array_column($resultados, 'Ganancia o Perdida Total');

         
            return [
                'labels' => $labels,
                'ganancias' => $ganancias,
                'costos' => $costos,
                'gananciaPerdidaTotal' => $gananciaPerdidaTotal,
            ];
        } catch (\PDOException $e) {
            echo 'Fallo la consulta: ' . $e->getMessage();
            return null;
        }
    }

    public function obtenerOrdenesVenta($fechaConsulta)
    {
        $ordenesVenta = array();
    
        try {
            $conexion = new Conexion();
            $conn = $conexion->conectar();
    
           
            $query = "SELECT Id_Orden_Venta, fecha, Costo_total FROM orden_ventas WHERE DATE(fecha) = :fecha";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':fecha', $fechaConsulta, PDO::PARAM_STR);
            $stmt->execute();
            $ordenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($ordenes as $orden) {
             
                $query = "SELECT p.nombre, p.precio_de_venta, d.Cantidad, p.costo FROM productos p 
                INNER JOIN detalle_de_orden_de_ventas d ON p.ID_Productos = d.Productos_ID_Productos
                WHERE d.Orden_Ventas_Id_Orden_Venta = :ID_Orden_Venta";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':ID_Orden_Venta', $orden['Id_Orden_Venta'], PDO::PARAM_INT);
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $ordenesVenta[] = array(
                    'id_orden' => $orden['Id_Orden_Venta'],
                    'fecha' => $orden['fecha'],
                    'productos' => $productos,
                    'total' => $orden['Costo_total']
                );
            }
        } catch (PDOException $e) {
            die('Error al obtener las órdenes de venta: ' . $e->getMessage());
        }
    
        return $ordenesVenta;
    }
    
    
    public function calcularTotalVentaDiario($fechaConsulta)
    {
        $ordenesVenta = $this->obtenerOrdenesVenta($fechaConsulta);
    
        $totalVenta = 0;
    
        foreach ($ordenesVenta as $orden) {
            
            $fechaOrden = date('Y-m-d', strtotime($orden['fecha']));
    
            if ($fechaOrden === $fechaConsulta) {
                $totalVenta += $orden['total'];
            }
        }
    
       
        return $totalVenta;
    }
    
    public function calcularCostoTotal($fechaConsulta)
    {
        $ordenesVenta = $this->obtenerOrdenesVenta($fechaConsulta);
    
        $costoTotal = 0;
    
        foreach ($ordenesVenta as $orden) {
            foreach ($orden['productos'] as $producto) {
                $cantidad = $producto['Cantidad']; 
                $costoProducto = $producto['costo']; 
                $costoTotal += ($cantidad * $costoProducto);
            }
        }
    
        return $costoTotal;
    }
    
        
    public function calcularGananciaTotal($fechaConsulta)
    {
        $totalVenta = $this->calcularTotalVentaDiario($fechaConsulta);
        $costoTotal = $this->calcularCostoTotal($fechaConsulta);
    
        $gananciaTotal = $totalVenta - $costoTotal;
    
         
    
        return $gananciaTotal;
    }

    public function obtenerGananciasPorSemana()
{
    $datosSemana = array();
    $fechaActual = date('Y-m-d');

    // Recorrer los últimos 7 días (desde el lunes hasta el domingo)
    for ($i = 0; $i < 7; $i++) {
        // Obtener la fecha para el día actual de la semana
        $fechaConsulta = date('Y-m-d', strtotime("-$i day", strtotime($fechaActual)));

        // Obtener los datos de ganancia y costo para el día actual
        $ganancia = $this->calcularGananciaTotal($fechaConsulta);
        $costo = $this->calcularCostoTotal($fechaConsulta);

        // Agregar los datos al arreglo de la semana
        $datosSemana[$fechaConsulta] = array(
            'ganancia' => $ganancia,
            'costo' => $costo,
        );
    }

    return $datosSemana;
}
public function obtenerDiaSemanaEnEspanol($fecha)
    {
        $dias_semana = [
            'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'
        ];

        $dia_semana_numero = date('w', strtotime($fecha));
        return $dias_semana[$dia_semana_numero];
    }

}

