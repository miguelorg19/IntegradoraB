<?php
class Usuario {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        session_start(); 
    }

    
    public function iniciarSesion($email, $password) {
        $consulta = "SELECT ID_Usuario, Nombre, Rol, Contrasenia FROM usuarios WHERE Correo = :email";
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
