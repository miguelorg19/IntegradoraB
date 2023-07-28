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
    public function orden($id_us)
    {
        try{
        $conexion = $this->conexion->conectar();
        $query = $conexion->prepare('SELECT Id_Orden_Venta,Fecha,Costo_Total,Estatus,Folio FROM orden_ventas WHERE Usuarios_ID_Usuario = :id_us');
        $query->execute([$id_us]);
        $ped = $query->fetchall(PDO::FETCH_ASSOC);
        return $ped;
        }
        catch (PDOException $e)
        {
            echo 'Fallo la conexion'. $e->getmessage();
        }finally{
            $this->conexion = null;
        }
    }

    public function detallesorden($id_us,$id_ov)
    {
        try{
        $conexion = $this->conexion->conectar();
        $query = $conexion->prepare('SELECT ov.Id_Orden_Venta,ov.Fecha,ov.Costo_Total,ov.Estatus,p.Nombre,p.Precio_de_Venta,p.ID_productos,i.Id_Imagen, i.imagen,dov.Orden_Ventas_Id_Orden_Venta, dov.Cantidad FROM orden_ventas ov 
        inner join detalle_de_orden_de_ventas dov on dov.Orden_Ventas_Id_Orden_Venta = ov.Id_Orden_Venta 
        inner join productos p on dov.Productos_ID_Productos = p.ID_Productos
        inner join imagenes i on p.ID_Productos = i.producto_ID_Producto WHERE ov.Id_Orden_Venta = ? AND ov.Usuarios_ID_Usuario = ?');
        $query->execute([$id_ov,$id_us]);
        $res = $query->fetchall(PDO::FETCH_ASSOC);
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

}
