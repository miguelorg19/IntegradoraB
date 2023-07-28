<?php
namespace src\Modelos;
require __DIR__ . '/../../vendor/autoload.php';
use PDOException;
session_start();

if (isset($_SESSION['ID_USUARIO'])) {
    $idUsuario = $_SESSION['ID_USUARIO'];
} else {
    header('Location: /../../public/views/login.php');
    exit();
}

class Actualizacion {
    private $conexion;

    public function __construct() {
        $conexion_instancia = new \src\Config\Conexion();
        $this->conexion = $conexion_instancia->conectar();
    }

    public function actualizarcorreo($idUsuario, $nuevoCorreo){
        if (empty($nuevoCorreo)) {
            return false;
        }
    
        try {
            $consulta = "UPDATE usuarios SET Correo = :correo WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
    
            $stmt->bindParam(':correo', $nuevoCorreo);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header('Location: ../../public/views/usuario.php');
                echo 'Se actualizó el correo correctamente.';   
                return true;
            } else {
                echo 'Error en la actualización (Verifique los datos o no se encontró el usuario).';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarnombre($idUsuario, $nuevoNombre){
        if (empty($nuevoNombre)) {
            return false;
        }
    
        try {
            $consulta = "UPDATE usuarios SET Nombre = :nombre WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
    
            $stmt->bindParam(':nombre', $nuevoNombre);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header('Location: ../../public/views/usuario.php');
                echo 'Se actualizó el nombre correctamente.';
                return true;
            } else {
                echo 'Error en la actualización (Verifique los datos o no se encontró el usuario).';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarapellidoP($idUsuario, $nuevoApellido){
        if (empty($nuevoApellido)) {
            return false;
        }
    
        try {
            $consulta = "UPDATE usuarios SET Apellido_Paterno = :apellido WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
    
            $stmt->bindParam(':apellido', $nuevoApellido);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header('Location: ../../public/views/usuario.php');
                echo 'Se actualizó el apellido correctamente.';
                return true;
            } else {
                echo 'Error en la actualización (Verifique los datos o no se encontró el usuario).';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarapellidoM($idUsuario, $nuevoApellido){
        if (empty($nuevoApellido)) {
            return false;
        }
    
        try {
            $consulta = "UPDATE usuarios SET Apellido_Materno = :apellido WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
    
            $stmt->bindParam(':apellido', $nuevoApellido);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header('Location: ../../public/views/usuario.php');
                echo 'Se actualizó el apellido correctamente.';
                return true;
            } else {
                echo 'Error en la actualización (Verifique los datos o no se encontró el usuario).';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarTelefono($idUsuario, $nuevoTelefono) {
         if (empty($nuevoTelefono)) {
            return false;
        }
    
        try {
            $consulta = "UPDATE usuarios SET Telefono = :telefono WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
    
            $stmt->bindParam(':telefono', $nuevoTelefono);
            $stmt->bindParam(':idUsuario', $idUsuario);
    
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                header('Location: ../../public/views/usuario.php');
                echo 'Se actualizó el telefono correctamente.';
                return true;
            } else {
                echo 'Error en la actualización (Verifique los datos o no se encontró el usuario).';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function guardarimg($imgname, $idUs, $imgtmp)
    {
        $directorio = '../../public/Usuarios/';
        $extension = pathinfo($imgname, PATHINFO_EXTENSION);
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
?>