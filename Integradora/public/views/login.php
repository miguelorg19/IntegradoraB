<?php

require '../../src/Config/database.php';
$db = new Conexion();
$con = $db->conectar();

if(isset($_POST['correo']) && isset($_POST['contraseña'])){

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$query = $con->prepare("SELECT * FROM Usuarios WHERE Correo = :correo LIMIT 1");

$query->execute(array(":correo"=>$correo));



$reg = $query->rowCount();

if($reg = $query->fetchALL(PDO::FETCH_ASSOC)){

    foreach($reg as $usuario){

        if(password_verify($contraseña, $usuario['Contrasenia'])){
            session_start();

            $_SESSION['ID_USUARIO'] = $usuario['ID_Usuario'];
            $_SESSION['NOMBRE_USUARIO'] = $usuario['Nombre'];
            
            header("location:catalogo.php");
            exit;
        }

    }
}
else{
    header("location:login.php");
}
    


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../css/login_styles/styles.css">
    <style>
        #logo{
            margin-top: 3vh;
            width: 20vh;
        }
    </style>
</head>
<body>
    <header>
        <img src="../imagenes/iniciar-sesion.png" alt="" id="IconIngresar">
        <h1>Bienvenido!</h1>
    </header>
    <div>
        <img src="../imagenes/zyro-image.png" alt="" id="logo">
    </div>
    <div class="container cont-form">

    
        
            <h2>Inicio De Sesión</h2>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form">
                <input type="text" class="form-control mb-4 mt-4" placeholder="Correo" name="correo">
                <input type="password" class="form-control mb-4" placeholder="Contraseña" name="contraseña">
               
                
                    <div id="ContBtn">
                        <button type="submit" id="ingresar">Ingresar</button>
                    </div>
        
                
            </form>
            <caption>
                <a href="../Productos/index.html" id="OlvidarContra">
                    ¿Olvidaste tu contraseña?
                </a>
            </caption>



        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>