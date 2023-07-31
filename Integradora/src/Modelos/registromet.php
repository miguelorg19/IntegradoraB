<?php
namespace src\Config;
require(__DIR__ . '/../Config/conexion.php');
require (__DIR__ . '/../../vendor/autoload.php');
require  (__DIR__ . '/../Config/validacionregistro.php');
require  __DIR__ . '/../Config/sanitizarregistro.php';
require_once (__DIR__ . '/../Config/conexion.php');
use src\Config\validacionesr;
use src\Config\Conexion;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use src\Config\sanitizarreg;




    
      
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
        
            public function Registro($nombre, $ApellidoPat, $ApellidoMat, $Telefono, $Correo, $Contraseña,$Codigo)
            {
                $hasheo = password_hash($Contraseña, PASSWORD_DEFAULT);
                $Rol = 'USUARIO';
                $Estado= 'INACTIVO';
                $mt = $this->database->prepare('INSERT INTO usuarios (Nombre, Apellido_paterno, Apellido_Materno, Telefono, Correo, Contrasenia, Rol,Estado,Cd_Verificacion) VALUES (?, ?, ?, ?, ?, ?,?,?,?)');
                $mt->execute([$nombre, $ApellidoPat, $ApellidoMat, $Telefono, $Correo, $hasheo, $Rol,$Estado,$Codigo]);
            }
        
            public function cerrarConexion()
            {
                $this->database = null;
            }
        }
        $registro = new Registro();
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
            $san = new sanitizarreg();
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
                  $mail = new PHPMailer(true);
                  try{
                    extract($_POST);
                        //Configuracion del servidor
                        $mail->SMTPDebug= SMTP::DEBUG_SERVER;
                        $mail->isSMTP();
                        $mail->Host      ='smtp.gmail.com';
                        $mail->SMTPAuth  = true;
                        $mail->Username = 'jakiepapeleria@gmail.com';
                        $mail->Password = 'lgdyyjwcnbhhaqmz';
                        $mail->SMTPSecure= PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port      =465;
                    
                        //Destinatario
                        $mail->setFrom('jakiepapeleria@gmail.com', 'jakie');
                    
                        $mail->addAddress($Correo,$nombre);
                        $mail->addReplyTo($Correo,$nombre);
                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Encoding = 'base64';
                
                
                
                        $mail->Subject = "Verificacion de Correo Electronico de ".($nombre)." ".($ApP);
                        $ruta = 'http://54.87.196.147/public/imagenes/jakiepape.png';
                
                        $Codigo= rand(100000,999999);
                
                        $mail->Body =' <html>
                        <head>
                            <style>
                             
                                body {
                                    font-family: Arial, sans-serif;
                                   
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color: #f4f4f4;
                                    border-radius: 10px;
                                    box-shadow: 0px 1rem 1rem darkorchid;
                                }
                                .logo {
                                    display: block;
                                    margin: 0 auto;
                                }
                                
                
                            </style>
                        </head>
                        <body>
                            <div class="container">
                            <img src="http://54.87.196.147/public/imagenes/jakiepape.png"style="width: 200px;
                                height: 90px;
                                filter: brightness(1.1);"/> 
                                <h1 style="font-family: Arial, sans-serif;">¡Hola!, Bienvenido '.$nombre.' '.$ApP.'!!!'.'</h1>
                             
                           <h3 style="font-family: Arial, sans-serif;">Estamos encantados de darte la bienvenida a nuestra tienda en línea. En Jacky Papelería, encontrarás todo lo que necesitas para tus proyectos creativos!</h3>
                            <h3 style="font-family: Arial, sans-serif;">Pero aun falta un paso para tu registro..</h3>
                           <h2 style="font-family: Arial, sans-serif;">Este es tu codigo de verificacion:</h2>
                           <h2 style="font-family: Arial, sans-serif;">'.$Codigo.'</h2>
                           <h3 style="font-family: Arial, sans-serif;">Ingreselo en la plataforma</h3>
                           <p><a href=""</p>
                           <h3 style="font-family: Arial, sans-serif;">Nuestro equipo de atención al cliente está aquí para ayudarte en cualquier momento. Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nosotros. Tu satisfacción es nuestra prioridad número uno.</h3>
                          <h3 style="font-family: Arial, sans-serif;">Gracias por elegir a Jacky Papelería. ¡Esperamos verte pronto!</h3>
                           
                           <h4 style="font-family: Arial, sans-serif;">Atentamente,</h4>
                           <h4 style="font-family: Arial, sans-serif;">El equipo de Jacky Papelería</h4>
                            </div>
                        </body>
                        </html>';    
                        header('Location: ../../public/views/verificacion.php?correo='.urlencode($Correo));
                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $mail->send();
                    header('Location: ../../public/views/verificacion.php?correo='.urlencode($Correo));
                        echo '<h1>Mensaje ha sido enviado</h1>';  
                    }
                    catch (Exception $e){
                            echo "Mensaje no se pudo enviar";
                        }
                    $registro->Registro($nombre, $apellidoPat, $apellidoMat, $telefonoSanitizado, $correoSanitizado, $contraseña,$Codigo);
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