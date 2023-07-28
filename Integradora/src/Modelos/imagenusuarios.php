<?php
namespace src\Config;
require_once __DIR__ . '/../Config/conexion.php';
class Imagenes{
    private $conexion;
    
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function obtenerimag($nombreimg){
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
        $sql = $conexion->prepare("SELECT Foto from usuarios where ID_Usuario = ?");
        $foto = $sql = execute([$idUs]);
        return $foto;
    }
    public function guardarimg($imgname, $idUs, $imgtmp)
    {
        $directorio = '../../public/Usuarios/';
        $extension = pathinfo($img, PATHINFO_EXTENSION);
        $nuevonombre = 'usuario_'. $idUs . '.' . $extension;
        $ruta = $directorio. $nuevonombre;
        if(move_uploaded_file($imgtmp, $ruta)){
        echo 'Imagen subida ';
        }
        else{
        }
        $sql = $conexion->prepare("UPDATE usuarios set Foto = ? where ID_Usuario = ?");
        $sql = execute([$nuevonombre, $idUs]);
    }
}