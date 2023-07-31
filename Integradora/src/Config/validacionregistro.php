<?php
namespace src\Config;
require __DIR__ . '/../../vendor/autoload.php';
require_once ('conexion.php');
use PDO;
use PDOException;
session_start();
class validacionesr{

    private $conexion;

    public function __construct() {
        $conexion_instancia = new \src\Config\Conexion();
        $this->conexion = $conexion_instancia->conectar();
    }

    public function correos($correo){

            if (empty($correo)){
                $_SESSION['Mensaje']= '<div class="alert alert-danger"">
                Campo correo electronico vació.
                </div>';
                header('Location:  ../../Integradora/public/views/registro.php');
                return false;
            }

            $correo = trim($correo);

            if (!preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $correo)) {
                $_SESSION['Mensaje']= '<div class="alert alert-danger" role="alert">
                El correo electrónico no tiene un formato válido.
                </div>';
                header('Location:  ../../public/views/registro.php');
                return false;
            }

            if ($this->correoExiste($correo)) {
                $_SESSION['Mensaje']= '<div class="alert alert-danger">
                El correo electronico ya esta registrado.
                </div>';
                header('Location:  ../../public/views/registro.php');
                return false;
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || strpos($correo, '@gmail.com') === false) {
                $_SESSION['Mensaje']= '<div class="alert alert-danger">
                    El correo electrónico no tiene un formato válido, solo formato @gmail.com
                    </div>';
                    header('Location:  ../../public/views/registro.php');
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
        $_SESSION['Mensaje']= '<div class="alert alert-danger">
        Campo nombre vacío.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
        $_SESSION['Mensaje']= '<div class="alert alert-danger">
        El nombre solo puede contener letras y espacios.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    return true;
}

public function apellidosP($apellido) {
    if (empty($apellido)){
        $_SESSION['Mensaje']= '<div class="alert alert-danger">
        Campo apellido paterno vacío.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    $apellido = trim($apellido);

    if (strlen($apellido) < 3 || strlen($apellido) > 50) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">
        El apellido debe tener entre 3 y 50 caracteres.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">
        El apellido paterno solo puede contener letras y espacios.
        </div>';
        header('Location:  ../Integradora/public/views/registro.php');
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
        $_SESSION['Mensaje']= '<div class="alert alert-danger">
        El apellido materno debe tener entre 3 y 50 caracteres.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) {
        $_SESSION['Mensaje']= '<div class="alert alert-danger">
        El apellido solo puede contener letras y espacios.
        </div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    return true;
}

public function telefonos(&$telefono) {
    if (empty($telefono)) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">Campo telefono vacío.</div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    $telefono = trim($telefono);
    $telefono = preg_replace('/[^0-9]/', '', $telefono);

    if(strlen($telefono) !== 10) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">Campo telefono solo puede contener 10 caracteres numericos</div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    return true;
}

public function contras($contras, $contrasConfirmacion) {
    if (empty($contras)) {
        $_SESSION['Mensaje']= '<div class="alert alert-danger">Debes ingresar una contraseña.</div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if (empty($contrasConfirmacion)) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">Debes confirmar la contraseña.</div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if ($contras !== $contrasConfirmacion) {
        $_SESSION['Mensaje']='<div class="alert alert-danger">Las contraseñas no coinciden.</div>';
        header('Location:  ../../public/views/registro.php');
        return false;
    }

    if(strlen($contras)<3){
        $_SESSION['Mensaje']='<div class="alert alert-danger">La contraseña debe contener al menos 3 caracteres</div>';
        header('Location:  ../../public/views/registro.php');
    }
    
    return true;
}
}
?>