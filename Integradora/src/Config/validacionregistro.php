<?php
namespace src\Config;
require __DIR__ . '/../../vendor/autoload.php';
require_once 'conexion.php';
use PDO;
use PDOException;
class validacionesr{

    private $conexion;

    public function __construct() {
        $conexion_instancia = new \src\Config\Conexion();
        $this->conexion = $conexion_instancia->conectar();
    }

    public function correos($correo){

            if (empty($correo)){
                echo '<div class="alert alert-danger" role="alert">
                Campo correo electronico vació.
                </div>';
                return false;
            }

            $correo = trim($correo);

            if (!preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $correo)) {
                echo '<div class="alert alert-danger" role="alert">
                El correo electrónico no tiene un formato válido.
                </div>';
                return false;
            }

            if ($this->correoExiste($correo)) {
                echo '<div class="alert alert-danger" role="alert">
                El correo electronico ya esta registrado.
                </div>';
                return false;
            }

            return true;
        }
    
        public function correoExiste($correo) {
            try {

                $consulta = $this->conexion->prepare("SELECT COUNT(*) AS total FROM usuarios WHERE Correo = :correo");
    
                $consulta->bindParam(':correo', $correo, PDO::PARAM_STR);
    
                $consulta->execute();
    
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
                return $resultado['total'] > 0;
            } catch(PDOException $e) {
                echo 'Error al consultar la base de datos'. $e->getMessage();
                return false;
            }
        }

public function nombres($nombre) {
    if (empty($nombre)){
        echo '<div class="alert alert-danger" role="alert">
        Campo nombre vacío.
        </div>';
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
        echo '<div class="alert alert-danger" role="alert">
        El nombre solo puede contener letras y espacios.
        </div>';
        return false;
    }

    return true;
}

public function apellidosP($apellido) {
    if (empty($apellido)){
        echo '<div class="alert alert-danger" role="alert">
        Campo apellido paterno vacío.
        </div>';
        return false;
    }

    $apellido = trim($apellido);

    if (strlen($apellido) < 3 || strlen($apellido) > 50) {
        echo '<div class="alert alert-danger" role="alert">
        El apellido debe tener entre 3 y 50 caracteres.
        </div>';
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
        echo '<div class="alert alert-danger" role="alert">
        El apellido paterno solo puede contener letras y espacios.
        </div>';
        return false;
    }

    return true;
}

public function apellidosM($apellido) {
    if (empty($apellido)){
        return true;
    }

    $apellido = trim($apellido);

    if (strlen($apellido) < 3 || strlen($apellido) > 50) {
        echo '<div class="alert alert-danger" role="alert">
        El apellido materno debe tener entre 3 y 50 caracteres.
        </div>';
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
        echo '<div class="alert alert-danger" role="alert">
        El apellido solo puede contener letras y espacios.
        </div>';
        return false;
    }

    return true;
}

public function telefonos($telefono) {
    if (empty($telefono)) {
        return 'Campo telefono vacío.';
    }

    $telefono = trim($telefono);
    $telefono = preg_replace('/[^0-9]/', '', $telefono);

    if (strlen($telefono) !== 10) {
        return 'El teléfono debe contener solo 10 caracteres numéricos.';
    }

    return true;
}

public function contras($contras, $contrasConfirmacion) {
    if (empty($contras)) {
        echo 'Debes ingresar una contraseña.';
        return false;
    }

    if (empty($contrasConfirmacion)) {
        echo 'Debes confirmar la contraseña.';
        return false;
    }

    if ($contras !== $contrasConfirmacion) {
        echo 'Las contraseñas no coinciden.';
        return false;
    }
    
    return true;
}

}
?>