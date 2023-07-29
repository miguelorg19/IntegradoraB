<?php
namespace src\Modelos;
require_once '../Config/conexion.php';
use PDO;
use PDOException;
class Usuario {
    private $db;

    public function __construct() {
        try {
            $conexion_instancia = new \src\Config\Conexion();
            $this->db = $conexion_instancia->conectar();
        } catch (PDOException $e) {
            header('Location: ../../public/views/usuario.php'); 
            $_SESSION['message'] = 'Error en la conexión a la base de datos: ' . $e->getMessage();
            exit();
        }
    }
    
    public function iniciarSesion($correo, $contraseña) {
        $query = "SELECT * FROM usuarios WHERE Correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($contraseña, $usuario['contrasenia'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['ID_Usuario'];
                $_SESSION['usuario_correo'] = $usuario['Correo'];
                $_SESSION['usuario_nombre'] = $usuario['Nombre'];
                $_SESSION['ApellidoP']=$usuario['Apellido_Paterno'];
                $_SESSION['ApellidoM']=$usuario['Apellido_Materno'];
                $_SESSION['Telefono']=$usuario['Telefono'];
                $_SESSION['usuario_rol'] = $usuario['Rol'];
                return true;
            }
        }
        echo '<div class="alert alert-danger" role="alert">
        Error de conexión: Correo o Contraseña incorrecta
        </div>';
        return false;
    }
    
}
?>
