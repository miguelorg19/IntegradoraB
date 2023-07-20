<?php

namespace src\Modelos;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../../vendor/autoload.php';

$mensajeEnvio = "";
$estiloMensaje = "";

class EnvioCorreo
{
    public function enviar($nombre, $email, $asunto, $mensaje)
    {

        $mail = new  PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jakiepapeleria@gmail.com';
            $mail->Password = 'lgdyyjwcnbhhaqmz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email,$nombre); // DirecciÃ³n de correo y nombre del remitente
            $mail->addAddress('jakiepapeleria@gmail.com', 'jakie');
            $mail->isHTML(true);
           $cuerpoMensaje = "<p>Nombre: {$nombre}</p>
                             <p>Correo electrónico: {$email}</p>
                             <p>Mensaje: {$mensaje}</p>";

            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpoMensaje;            // Enviar el correo
            $rta = $mail->send();

            $mail->clearAllRecipients();
            if ($rta) {
                $mensajeEnvio = "El correo se envió correctamente";
                $estiloMensaje = "text-success";
            } else {
                $mensajeEnvio = "Error al enviar el correo";
                $estiloMensaje = "text-danger";
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo: " . $e->getMessage();
        }
    }
}

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['Asunto'];
    $mensaje = $_POST['mensaje'];

    $errors = array();

    // ...

    if (count($errors) == 0) {
        $correo = new EnvioCorreo();
        $correo->enviar($nombre, $email, $asunto, $mensaje);

  
    } else {

        header('Location: papemaxinicio.php?error=email');
        exit();
    }
}
