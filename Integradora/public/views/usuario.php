<?php
require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
session_start();
if(isset($_SESSION['NOMBRE_USUARIO'])){
  $nombreus = $_SESSION['NOMBRE_USUARIO'];
}
else
{
  header("location:login.php");
}
if (isset($_SESSION['ID_USUARIO'])) {
  $idUsuario = $_SESSION['ID_USUARIO'];
} 
else {
  header("location:login.php");
}

$imagenes = new Imagenes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300&family=Noto+Sans+JP:wght@500&family=Rubik:wght@300&family=Ubuntu:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Usuario</title>
    <style>
      .conss{
        padding: 3%;
      }
      .pw{
        margin: 0 auto;
        background-color: #f4f4f4;
        border-radius: .5rem;
        box-shadow: 0px .5rem .5rem gray;
      }
      input{
            border-radius: .5rem;
            font-size: .9rem;
            box-shadow: 0px 5px 10px -6px gray;
            font-family: 'Inter', sans-serif;
            width:22rem;
        }
        .text{
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            font-size: .9rem;
        }
        .imgus{
          width: 200px; 
          height: 200px;
          border-radius: 100%;
        }
    </style>
</head>
<body>
<header>
      <nav class="navbar navbar-expand-md" style="background-color:black;">
        <div class="container-fluid">
        <button class="navbar-toggler bg-secondary col-12" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
        
        <div class="collapse navbar-collapse col-lg-11 col-sm-6 col-md-6" id="menu">
            <ul class="navbar-nav d-flex justify-content-center">
              <li class="nav-item">
              <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><img src="../imagenes/menu.png" width="40" height="40"></a>
              <ul class="dropdown-menu bg-light">
                <li>
                  <a class="dropdown-item" href="">Inicio</a>
                </li>
                <li>
                  <a class="dropdown-item" href="">Catalogo</a>
                </li>
                <li>
                  <a class="dropdown-item" href="registroventas.php">Registro de ventas</a>
                </li>
                <li>
                  <a class="dropdown-item" href="registrocompras.php">Registro de compras</a>
                </li>
                <li>
                  <a class="dropdown-item" href="">Ventas diarias</a>
                </li>
                  <li>
                  <a class="dropdown-item" href="">Ventas mensuales</a>
                </li>
                <li>
                  <a class="dropdown-item" href="pedidos.php">Pedidos</a>
                </li>
              </ul>
                </li>
            </ul>
        <div class="collapse navbar-collapse col-lg-1 col-sm-6 col-md-6 d-flex justify-content-end con" id="menu">
            <ul class="navbar-nav">
              <li class="nav-item">
              <img src="../imagenes/carrito.png" width="40" height="40">
              </li>
        </div>      
        </div>
  </nav>
</header>
      <div class="container mt-4 d-flex justify-content-center row pw col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12 d-flex justify-content-center conss">
        <form action="../../src/Modelos/actualizar.php" method="post">
            <div  class="d-flex justify-content-center">
            <?php 
            $foto = $imagenes->verfoto($idUsuario);
            if(!empty($foto)){
              $url = $foto;
              $img = $imagenes->obtenerimaus($url);
            }
            else{
              $img = '../imagenes/usuario.png';
            }
            ?>
            <img src="<?php echo $img ?>" class="imgus">
            </div>
            <div class="d-flex justify-content-center">
            <h5>Seleccione una imagen</h5>
            </div>
            <div class="d-flex justify-content-center mt-2">
            <input type="file" name="img"  accept=".jpg, .jpeg, .png">
            </div>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['Mensaje'])) {
          echo $_SESSION['Mensaje'];
          unset($_SESSION['Mensaje']);
      }
        ?>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 conss">
        <form action="../../src/Modelos/actualizar.php" method="post">
        <input type="text" class="form-control tex" placeholder="Nombre" value="<?php echo $_SESSION['NOMBRE_USUARIO']?>" aria-label="Recipient's username" name="Nombre" aria-describedby="button-addon2">
        <input type="text" class="form-control tex mt-3" placeholder="Apellido Paterno" value="<?php echo $_SESSION['ApellidoP']?>" name="ApeP" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input type="text" class="form-control tex mt-3" value="<?php echo $_SESSION['ApellidoM']?>" name="ApeM" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input type="text" class="form-control tex mt-3" value="<?php echo $_SESSION['Telefono']?>" name="telefono" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input type="email" class="form-control tex mt-3" value="<?php echo $_SESSION['Correo']?>" name="correo" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12  d-flex justify-content-end">
        <button type="submit" name="guardar" class="btn btn-dark text" style="margin-right:2%">Actualizar</button>
        <button type="submit" name="listo" class="btn btn-success text" style="margin-right:1.5%">Guardar</button>
        </form>
        </div>
        <div>

        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>