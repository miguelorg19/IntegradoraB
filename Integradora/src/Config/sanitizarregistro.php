<?php
namespace src\Config;
class sanitizarreg{
    public function sancorreo(&$correo){
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        return $correo;
    }

    public function sannombre(&$nombre){
        $nombre = trim($nombre);

        $nombre = ucwords(strtolower($nombre));
    
        $nombre = preg_replace('/[^a-zA-Z\s]+/', '', $nombre);
    
        return $nombre;
    }

    public function sanapellidos(&$apellido){
        $apellido = trim($apellido);

        $apellido = ucwords(strtolower($apellido));
    
        $apellido = preg_replace('/[^a-zA-Z\s]+/', '', $apellido);
    
        return $apellido;
    }

    public function santelefonos(&$telefono){
        $telefonoSanitizado = preg_replace('/[^0-9]/', '', $telefono);

        return $telefonoSanitizado;
    }
}
?>