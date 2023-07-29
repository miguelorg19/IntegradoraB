<?php
namespace src\Modelos;
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
                $_SESSION['usuario_id'] = $usuario['ID_Usuario'];
                $_SESSION['usuario_correo'] = $usuario['Correo'];
                $_SESSION['usuario_nombre'] = $usuario['Nombre'];
                $_SESSION['usuario_rol'] = $usuario['Rol'];
                return true;
            }
        }
        echo '<div class="alert alert-danger" role="alert">
        Error de conexión: Correo o Contraseña incorrecta
        </div>';
        return false;
    }

    public function sesionIniciada() {
        return isset($_SESSION['usuario_id']);
    }

    public function cerrarSesion() {
        session_unset();
        session_destroy();
    }
    
}
?>
