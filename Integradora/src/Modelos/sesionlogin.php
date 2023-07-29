<?php
namespace src\Modelos;
require __DIR__ . '/../Config/conexion.php';
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
    
    public function iniciarSesion($email, $password) {
        $consulta = "SELECT * FROM usuarios WHERE Correo = :email";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Utilizamos fetch para obtener el resultado directamente
    
        if ($usuario && password_verify($password, $usuario['Contrasenia'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['ID_Usuario'];
            $_SESSION['usuario_correo'] = $usuario['Correo'];
            $_SESSION['usuario_nombre'] = $usuario['Nombre'];
            $_SESSION['ApellidoP'] = $usuario['Apellido_Paterno'];
            $_SESSION['ApellidoM'] = $usuario['Apellido_Materno'];
            $_SESSION['Telefono'] = $usuario['Telefono'];
            $_SESSION['usuario_rol'] = $usuario['Rol'];
            return true; // Autenticación exitosa, retornamos true
        }
    
        return false; // Autenticación fallida, retornamos false
    }
    
    
    
}
?>
