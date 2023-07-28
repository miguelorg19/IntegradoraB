<?php
namespace src\Modelos;
require __DIR__ . '/../../vendor/autoload.php';
use pdo;
class Usuario {
    private $conexion;

    public function __construct() {
        $conexion_instancia = new \src\Config\Conexion();
        $this->conexion = $conexion_instancia->conectar();
    }

    
    public function iniciarSesion($email, $password) {
        $consulta = "SELECT * FROM usuarios WHERE Correo = :email";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashContraseñaAlmacenada = $usuario["Contrasenia"];
    
            if (password_verify($password, $hashContraseñaAlmacenada)) {
                session_start();
                $_SESSION['ID_USUARIO'] = $usuario['ID_Usuario'];
                $_SESSION['NOMBRE_USUARIO'] = $usuario['Nombre'];
                $_SESSION['ApellidoP'] = $usuario['Apellido_Paterno'];
                $_SESSION['ApellidoM'] = $usuario['Apellido_Materno'];
                $_SESSION['Telefono'] = $usuario['Telefono'];
                $_SESSION['Correo'] = $usuario['Correo'];
                $_SESSION['ROL'] = $usuario['Rol'];
                
                echo 'Conexión exitosa';
    
                return true;
            } else {
                echo 'Contraseña incorrecta';
            }
        } else {
            echo 'El usuario no existe';
        }
        
        return false;
    }
    
}
?>
