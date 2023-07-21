<?php
namespace src\Config;
require_once __DIR__ . '/../config/conexion.php';
class imagenes{
    public function obtenerimag($nombreimg){
        $dir = __DIR__.'/../../public/Productos/';
        $path = "{$dir}{$nombreimg}";
        $data = file_get_contents($path);
        $bas64 = base64_encode($data);
        $tipo = mime_content_type($path);
        $base64 = "data:{$tipo};base64,{$bas64}";
        return $base64;
    }
}