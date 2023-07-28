<?php
class validacionesr{

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    public function correoElectronicoExistente($correo) {
        $correo = mysqli_real_escape_string($this->conexion, $correo);
    
        $consulta = "SELECT COUNT(*) as total FROM usuarios WHERE correo = '$correo'";
        $resultado = mysqli_query($this->conexion, $consulta);

        $fila = mysqli_fetch_assoc($resultado);


        return $fila['total'] > 0;
    }

    public function correos($correo){

        if (empty($correo)){
            echo '<div class="alert alert-danger" role="alert">
            Campo vació.
            </div>';
            return false;
        }

        $correo = trim($correo);

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger" role="alert">
            El correo electronico no tiene un formato valido.
            </div>';
            return false;
        }

        if ($this->correoElectronicoExistente($correo)) {
            echo '<div class="alert alert-danger" role="alert">
            El correo electronico ya esta registrado.
            </div>';
            return false;
        }

        return true;
    }

    public function nombres($nombre){

        if (empty($correo)){
            echo '<div class="alert alert-danger" role="alert">
            Campo vació.
            </div>';
            return false;
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
            echo '<div class="alert alert-danger" role="alert">
            El nombre solo pueden contener letras y espacios.
            </div>';
            return false;
        }

        return true;
    }

    public function apellidosP($apellido){
        if (empty($correo)){
            echo '<div class="alert alert-danger" role="alert">
            Campo vació.
            </div>';
            return false;
        }
        $apellido = trim($apellido);

        if (strlen($apellido) < 3 || strlen($apellido) > 50) {
        return false;
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
            echo '<div class="alert alert-danger" role="alert">
            El apellido solo pueden contener letras y espacios.
            </div>';
            return false;
        }
        return true;
    }

    public function apellidosM($apellido){
        if (empty($apellido)){
            return true;
        }
        $apellido = trim($apellido);

        if (strlen($apellido) < 3 || strlen($apellido) > 50) {
        return false;
        }
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
            echo '<div class="alert alert-danger" role="alert">
            El apellido solo pueden contener letras y espacios.
            </div>';
            return false;
        }
    }

    public function telefonos($telefono){

        if (empty($telefono)){
            echo '<div class="alert alert-danger" role="alert">
            Campo vació.
            </div>';
            return false;
        }
        $telefono = trim($telefono);
    
        $telefono = preg_replace('/[^0-9]/', '', $telefono);

        if (strlen($telefono) !== 10) {
            return false;
        }

        return true;
    }

    public function contraseñas($contraseña){

        if (empty($contraseña)){
            echo '<div class="alert alert-danger" role="alert">
            Campo vació.
            </div>';
            return false;
        }
        if (strlen($contraseña) < 8) {
            return "La contraseña debe tener al menos 8 caracteres.";
        }

        if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+-=]+$/', $contraseña)) {
            return false;
        }

        return true;
    }
}
?>