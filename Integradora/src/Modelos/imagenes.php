<?php
namespace src\Config;
require_once __DIR__ . '/../Config/conexion.php';
use PDO;
use PDOException;
class Imagenes{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function obtenerimag($nombreimg){
        $dir = __DIR__.'/../../public/Productos/';
        $path = "{$dir}{$nombreimg}";
        $data = file_get_contents($path);
        $bas64 = base64_encode($data);
        $tipo = mime_content_type($path);
        $base64 = "data:{$tipo};base64,{$bas64}";
        return $base64;
    }

    public function obtenerimaus($nombreimg){
        $dir = __DIR__.'/../../public/Usuarios/';
        $path = "{$dir}{$nombreimg}";
        $data = file_get_contents($path);
        $bas64 = base64_encode($data);
        $tipo = mime_content_type($path);
        $base64 = "data:{$tipo};base64,{$bas64}";
        return $base64;
    }
    public function verfoto($idUs)
    {
        $conexion = $this->conexion->conectar();
        $sql = $conexion->prepare("SELECT Foto from usuarios where ID_Usuario = ?");
        $sql->execute([$idUs]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);  
        $foto = $resultado['Foto'];
        return $foto;


    }
}