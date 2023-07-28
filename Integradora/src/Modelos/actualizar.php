<?php
require_once 'actualizacionusuarios.php';
require __DIR__ . '/../Config/validarusuario.php';
require __DIR__ . '/../Config/snitizarusuario.php';
use src\Config\validacionesr;
use src\Config\sanitizarregi;
use src\Modelos\Actualizacion;
$validar = new validacionesr();
$san = new sanitizarregi();
$actualiza = new Actualizacion();
if (isset($_SESSION['ID_USUARIO'])) {
 -   $idUsuario = $_SESSION['ID_USUARIO'];
} else {
    header('Location: /../../public/views/login.php');
    exit();
}

if (isset($_POST['listo'])) {
    header('Location: /../Integradora/public/views/catalogo.php');
    exit();
 }
 

 if (isset($_POST['guardar'])) {

     if (!empty($_POST['Nombre'])) {
         $nombre = $_POST["Nombre"];
         $nombreValido = $validar->nombres($nombre);
         if ($nombreValido) {
             $nombreSanitizado = $san->sannombre($nombre);
             if ($nombreSanitizado) {
                 $actualiza->actualizarnombre($idUsuario, $nombreSanitizado);
                 $_SESSION['NOMBRE_USUARIO'] = $nombreSanitizado;
             }
         }
     }
 
     if (!empty($_POST['ApeP'])) {
         $apellidoPat = $_POST["ApeP"];
         $apellidoPatValido = $validar->apellidosP($apellidoPat);
         if ($apellidoPatValido) {
             $apellidoPatSanitizado = $san->sanapellidos($apellidoPat);
             if ($apellidoPatSanitizado) {
                 $actualiza->actualizarapellidoP($idUsuario, $apellidoPatSanitizado);
                 $_SESSION['ApellidoP'] = $apellidoPatSanitizado;
             }
         }
     }
 
     if (!empty($_POST['ApeM'])) {
         $apellidoMat = $_POST["ApeM"];
         $apellidoMatValido = $validar->apellidosP($apellidoMat);
         if ($apellidoMatValido) {
             $apellidoMatSanitizado = $san->sanapellidos($apellidoMat);
             if ($apellidoMatSanitizado) {
                 $actualiza->actualizarapellidoM($idUsuario, $apellidoMatSanitizado);
                 $_SESSION['ApellidoM'] = $apellidoMatSanitizado;
             }
         }
     }
 
     if (!empty($_POST['telefono'])) {
         $telefono = $_POST["telefono"];
         $telefonoValido = $validar->telefonos($telefono);
         if ($telefonoValido) {
             $telSanitizado = $san->santelefonos($telefono);
             if ($telSanitizado) {
                 $actualiza->actualizarTelefono($idUsuario, $telSanitizado);
                 $_SESSION['Telefono'] = $telSanitizado;
             }
 
         }
     }
if(!empty($_POST['telefono'])){
if(isset($_POST['telefono']) && isset($_POST['guardar'])){
    $telefono = $_POST["telefono"];
    $telefonoValido = $validar->telefonos($telefono);
    if ($telefonoValido){
        $telSanitizado = $san->santelefonos($telefono);
        $actualiza->actualizarTelefono($idUsuario,$telefono);
    }
}}

if(!empty($_POST['correo'])){
if(isset($_POST['correo'])){
    $correo = $_POST["correo"];
    $correoValido = $validar->correos($correo);
    if($correoValido){
        $correoSanitizado = $san->sancorreo($correo);
        $actualiza->actualizarcorreo($idUsuario,$correoSanitizado);
    }
}
}

if(!empty($_FILES['img'])){
    header('Location: ../../public/views/usuario.php');
    if(isset($_FILES['img'])){
        $img = $_FILES["img"];
        $imgname = $img['name'];
        $imgtmp = $img['tmp_name'];
        $actualiza->guardarimg($imgname, $idUsuario, $img);
    }
}
if(isset($_POST['listo'])){
   echo '<meta http-equiv="refresh" content="1;url=/../../public/views/catalogo.php">';
}

 }
?>