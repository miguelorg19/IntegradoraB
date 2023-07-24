<?php
namespace src\Config;
require_once (__DIR__ . '/../Config/conexion.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Registro
{
    private $con;
    private $database;

    public function __construct()
    {
        try {
            $this->con = new Conexion();
            $this->database = $this->con->conectar();
        } catch (\PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function comprobarConexion()
    {
        // Verificar el estado de la conexión
        $estadoConexion = $this->database->getAttribute(\PDO::ATTR_CONNECTION_STATUS);
        if ($estadoConexion === false) {
            die("La conexión a la base de datos no está establecida correctamente.");
        }

        // Realizar una consulta simple para verificar si todo funciona bien
        $consulta = $this->database->query('SELECT 1');
        if ($consulta === false) {
            die("Error al ejecutar la consulta: " . $this->database->errorInfo()[2]);
        }

        echo "La conexión a la base de datos se ha establecido correctamente.";
    }

    public function usuarios()
    {
        $consulta = $this->database->query('SELECT * FROM usuarios');
        return $consulta->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function Registro($nombre, $ApellidoPat, $ApellidoMat, $Telefono, $Correo, $Contraseña)
    {
        $hasheo = password_hash($Contraseña, PASSWORD_DEFAULT);
        $Rol = 'USUARIO';
        $mt = $this->database->prepare('INSERT INTO usuarios (Nombre, Apellido_paterno, Apellido_Materno, Telefono, Correo, Contrasenia, Rol) VALUES (?, ?, ?, ?, ?, ?,?)');
        $mt->execute([$nombre, $ApellidoPat, $ApellidoMat, $Telefono, $Correo, $hasheo, $Rol]);
    }

    public function cerrarConexion()
    {
        $this->database = null;
    }
}

$registro = new Registro();

// Verificar si se envió el formulario y procesar los datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidoPat = $_POST["ApP"];
    $apellidoMat = $_POST["ApM"];
    $telefono = $_POST["Telefono"];
    $correo = $_POST["Correo"];
    $contraseña = $_POST["Contraseña"];

        extract($_POST);
        
        if (empty($nombre) || empty($apellidoPat) || empty($apellidoMat) || empty($telefono) || empty($correo) || empty($contraseña)) {
            echo 'Faltan campos por llenar';
            header('Location:  /../../public/views/registro.php');
            exit;
        }
        else{
        $obj = new Registro();
        $obj->Registro($nombre, $apellidoPat, $apellidoMat, $telefono,$correo,$contraseña);
        echo 'registro exitoso';
        header('Location: /../../public/views/usuario.php');
        $obj -> cerrarConexion();
        exit;
        }
}
?>