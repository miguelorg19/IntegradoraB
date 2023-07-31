<?php
namespace src\Config;

require_once __DIR__ . '/../Config/conexion.php';
use PDO;
use PDOException;

class Pedidos{
    private $conexion;

    public function __construct()
    {
            $this->conexion = new Conexion();
    }
    public function orden()
    {
        try{
        $conexion = $this->conexion->conectar();
        $query = $conexion->query('SELECT Id_Orden_Venta,Fecha,Costo_Total,Estatus FROM orden_ventas');
        $ped = $query->fetchall(\PDO::FETCH_ASSOC);
        return $ped;
        }
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }finally{
            $this->conexion = null;
        }
    }
    public function detallesorden($id)
    {
        try{
        $conexion = $this->conexion->conectar();
        $query = $conexion->prepare('SELECT ov.Id_Orden_Venta,ov.Fecha,ov.Costo_Total,ov.Estatus,p.Nombre,p.precio_de_Venta,p.ID_productos,i.Id_Imagen, i.imagen,dov.Orden_Ventas_Id_Orden_Venta, dov.Cantidad FROM orden_ventas ov 
        inner join detalle_de_orden_de_ventas dov on dov.Orden_Ventas_Id_Orden_Venta = ov.Id_Orden_Venta 
        inner join productos p on dov.Productos_ID_Productos = p.ID_Productos
        inner join imagenes i on p.ID_Productos = i.producto_ID_Producto where ov.Id_Orden_Venta = ?;');
        $query->execute([$id]);
        $res = $query->fetchall(\PDO::FETCH_ASSOC);
        return $res;
        }
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }
    }
    public function tot($id, $prodid)
    {
        try{
            $conexion = $this->conexion->conectar();
            $query = $conexion -> prepare('CALL CalcularTotalPorDetalle(?,?)');
            $query -> execute([$id,$prodid]);
            $resultado = $query->fetchColumn();
            return $resultado;
        }  
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }
    }
    public function obteneridpr($id){
        try{
            $conexion = $this->conexion->conectar();
            $query = $conexion -> prepare('SELECT Productos_ID_Productos from detalle_de_orden_de_ventas inner join productos on ID_Productos = Productos_ID_Productos inner join orden_ventas on Id_Orden_Venta = Orden_Ventas_Id_Orden_Venta WHERE Orden_Ventas_Id_Orden_Venta = ?;');
            $query -> execute([$id]);
            $resultado = $query->fetchAll(\PDO::FETCH_COLUMN);
            return $resultado;
        }
        catch(PDOException $e){
            echo 'Fallo la conexion'. $e->getmessage();
        }

    }

    public function actualizarEstadoPedido($orderId, $nuevoEstado)
    {
        try {
            $conexion = $this->conexion->conectar();
            $sql = $conexion->prepare('UPDATE orden_ventas set Estatus = ? where Id_Orden_Venta = ?');
            $sql->execute([$nuevoEstado, $orderId]);
        } catch (PDOException $e) {
            echo'fallo la conexion';
        }
    }
}
