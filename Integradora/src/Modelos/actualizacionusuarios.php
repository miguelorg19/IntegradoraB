<?php
namespace src\Modelos;
require __DIR__ . '/../../vendor/autoload.php';
require_once '../Config/conexion.php';
use PDOException;
session_start();

if (isset($_SESSION['usuario_id'])) {
    $idUsuario = $_SESSION['usuario_id'];
   } else {
       header('Location: /../../public/views/login.php');
       exit();
   }
class Actualizacion {
    private $conexion;

    public function __construct() {
        try {
            $conexion_instancia = new \src\Config\Conexion();
            $this->conexion = $conexion_instancia->conectar();
        } catch (PDOException $e) {
            header('Location: ../../public/views/usuario.php'); 
            $_SESSION['message'] = 'Error en la conexión a la base de datos: ' . $e->getMessage();
            exit();
        }
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
                $_SESSION['message'] = '<div class="alert alert-success">Se actualizó el correo correctamente.</div>';  
                header('Location: ../../public/views/usuario.php');
                 
                return true;
            } else {
                header('Location: ../../public/views/usuario.php'); 
                $_SESSION['message'] = '<div <div class="alert alert-danger">Error en la  actualización del correo (Verifique los datos o no se encontró el usuario).</div>';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
        finally{
            $this->conexion = null;
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
                $_SESSION['message'] = '<div class="alert alert-success">Se actualizó el nombre correctamente.</div>';
                header('Location: ../../public/views/usuario.php');

                return true;
            } else {
                $_SESSION['message'] ='<div class="alert alert-danger">Error en la  actualización del nombre (Verifique los datos o no se encontró el usuario).</div>';
                header('Location: ../../public/views/usuario.php'); 
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
        finally{
            $this->conexion = null;
        }
    }

    public function actualizarapellidoP($idUsuario, $nuevoApellido){
        if (empty($nuevoApellido)) {
            return false;
        }  
        try {
            $consultas = "UPDATE usuarios SET Apellido_Paterno = :apellido WHERE ID_Usuario = :idUsuario";
            $stmt = $this->conexion->prepare($consultas);
            $stmt->bindParam(':apellido', $nuevoApellido); 
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
            print_r($stmt);
            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] ='<div class="alert alert-success">Se actualizó el apellido Paterno correctamente.</div>';
                header('Location: ../../public/views/usuario.php'); 

                return true;
            } else {
                header('Location: ../../public/views/usuario.php'); 
                $_SESSION['message'] = '<div class="alert alert-danger">Error en la actualización del apellido Paterno (Verifique los datos o no se encontró el usuario).</div>';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        } finally {
            $this->conexion = null;
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
                $_SESSION['message'] = '<div class="alert alert-success">Se actualizó el apellido Materno correctamente.</div>'; 

                return true;
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger">Error en la actualización del Apellido Materno (Verifique los datos o no se encontró el usuario).</div>';
                header('Location: ../../public/views/usuario.php'); 
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        } finally {
            $this->conexion = null;
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
                $_SESSION['message'] = '<div class="alert alert-success">Se actualizó el telefono correctamente.</div>';
                header('Location: ../../public/views/usuario.php');
                return true;
            } else {
                header('Location: ../../public/views/usuario.php'); 
                $_SESSION['message'] = '<div class="alert alert-danger">Error en la actualización del telefono (Verifique los datos o no se encontró el usuario).</div>';
                return false; 
            }
        } catch (PDOException $e) {
            return false;
        }
        finally{
            $this->conexion = null;
        }      
    }
    
    public function guardarimg($imgname, $idUs, $imgtmp)
    {
        $directorio = '../../public/Usuarios/';
        $extension = pathinfo($imgname, PATHINFO_EXTENSION);
        $nuevonombre = 'usuario_'. $idUs . '.' . $extension;
        $ruta = $directorio. $nuevonombre;
        if(move_uploaded_file($imgtmp, $ruta)){
        $_SESSION['message'] ='Imagen subida ';
        header('Location: ../../public/views/usuario.php'); 
        }
        else{
            $_SESSION['message']='error al subir imagen';
            header('Location: ../../public/views/usuario.php'); 
        
        }
        $sql = $this->conexion->prepare("UPDATE usuarios set Foto = ? where ID_Usuario = ?");
        $sql ->execute([$nuevonombre, $idUs]);
    }
    

}
?>