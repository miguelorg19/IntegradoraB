<?php
namespace src\Config;
require __DIR__ . '/../Config/conexion.php';
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Config/validacionregistro.php';
require __DIR__ . '/../Config/sanitizarregistro.php';

use sanitizarreg as GlobalSanitizarreg;
use src\Config\validacionesr;
use src\Config\sanitizarreg;
use src\Config\Conexion;
require_once (__DIR__ . '/../Config/conexion.php');
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
    session_start();
    $nombre = $_POST["nombre"];
    $apellidoPat = $_POST["ApP"];
    $apellidoMat = $_POST["ApM"];
    $telefono = $_POST["Telefono"];
    $correo = $_POST["Correo"];
    $contraseña = $_POST["Contraseña"];
    $contraseña2 = $_POST['Contra'];
    $validar = new validacionesr();
    $san = new Sanitizarreg();
    $_SESSION['nombre']=$_POST["nombre"];
    $_SESSION['ApP']=$_POST["ApP"];
    $_SESSION['ApM']=$_POST["ApM"];
    $_SESSION['Tel']=$_POST['Telefono'];
    $_SESSION['Correo']=$_POST['Correo'];

    $nombreValido = $validar->nombres($nombre);
    $apellidoPatValido = $validar->apellidosP($apellidoPat);
    $apellidoMatValido = $validar->apellidosM($apellidoMat);
    $telefonoValido = $validar->telefonos($telefono);
    $correoValido = $validar->correos($correo);
    $contraseñaValida = $validar->contras($contraseña,$contraseña2);

    if ($nombreValido && $apellidoPatValido && $apellidoMatValido && $telefonoValido && $correoValido && $contraseñaValida) {
        $nombreSanitizado = $san->sannombre($nombre);
        $apellidoPatSanitizado = $san->sanapellidos($apellidoPat);
        $apellidoMatSanitizado = $san->sanapellidos($apellidoMat);
        $telefonoSanitizado = $san->santelefonos($telefono);
        $correoSanitizado = $san->sancorreo($correo);

        if($nombreSanitizado && $apellidoPatSanitizado && $apellidoMatSanitizado && $telefonoSanitizado && $correoSanitizado){
          $registro = new Registro();
            $registro->Registro($nombre, $apellidoPat, $apellidoMat, $telefonoSanitizado, $correoSanitizado, $contraseña);
            session_unset();
            session_destroy();
            $_SESSION['Mensaje'] = '<div class="alert alert-success" role="alert">Registro exitoso</div>';
            header('Location:  /../Integradora/public/views/login.php');
            return true;  
        }

        return false;
    }
        extract($_POST);
        if (empty($nombre) || empty($apellidoPat) || empty($apellidoMat) || empty($telefono) || empty($correo) || empty($contraseña)) {
         
            echo 'Faltan campos por llenar';
            header('Location:  /../../public/views/registro.php');
            exit;
        }

    }

?>