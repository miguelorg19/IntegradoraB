<?php
require_once 'actualizacionusuarios.php';
require '../Config/sanitizarregistro.php';
require '../Config/validacionregistro.php';
use src\Modelos\Actualizacion;
use src\Config\validacionesr;
use src\Config\sanitizarreg;
$validar = new validacionesr();
$san = new sanitizarreg();
$actualiza = new Actualizacion();
if (isset($_SESSION['ID_USUARIO'])) {
 -   $idUsuario = $_SESSION['ID_USUARIO'];
} else {
    header('Location: /../../public/views/login.php');
    exit();
}

if(!empty($_POST['Nombre'])){
if(isset($_POST['Nombre']) && isset($_POST['guardar'])){
    $nombre = $_POST["Nombre"];
    $nombreValido = $validar->nombres($nombre);
    if ($nombreValido){
        $nombreSanitizado = $san->sannombre($nombre);
        $actualiza->actualizarnombre($idUsuario,$nombre);
    }
}
}

if(!empty($_POST['ApeP'])){
    if(isset($_POST['ApeP'])){
        $apellidoPat = $_POST["ApeP"];
        $apellidoPatValido = $validar->apellidosP($apellidoPat);
        if($apellidoPatValido){
            $apellidoPatSanitizado = $san->sanapellidos($apellidoPat);
            $actualiza->actualizarapellidoP($idUsuario,$apellidoPat);
        }
    }
}

if(!empty($_POST['ApeM'])){
    if(isset($_POST['ApeM'])){
        $apellidoMat = $_POST["ApeM"];
        $apellidoMatValido = $validar->apellidosP($apellidoMat);
        if($apellidoMatValido){
            $apellidoMatSanitizado = $san->sanapellidos($apellidoMat);
            $actualiza->actualizarapellidoP($idUsuario,$apellidoMat);
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
?>