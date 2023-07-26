<?php
require_once __DIR__ . '/../../src/Modelos/consultaspedidos.php';

use src\Config\Pedidos;
$productos = new Pedidos();
$datos = $productos->orden();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
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
    <style>
        .pw{
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: .5rem;
            padding: 1rem;
            box-shadow: 0px .3rem .3rem gray;
        }
        .tex{
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .te{
            font-size: 2.5rem;
            text-color:gray;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        @media (min-width: 200px) and (max-width: 400px){
            .btn2{
                margin-top: 5%;
            }
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
        
        <div class="collapse navbar-collapse col-lg-11 col-sm-6 col-md-6 " id="menu" >
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
              </ul>
                </li>
            </ul>
        <div class="collapse navbar-collapse col-lg-1 col-sm-6 col-md-6 d-flex justify-content-end con" id="menu">
            <ul class="navbar-nav">
              <li class="nav-item">
              <a href="usuario.php"><img src="../imagenes/usuario.png" width="40" height="40"></a>
              <img src="../imagenes/carrito.png" width="40" height="40">
              </li>
        </div>      
        </div>
  </nav>
</header>
    <div class="container table-responsive mt-4 d-flex justify-content-center row pw col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12">
    <h1 class="te">Pedidos</h1>
    <form>
    <table class="table table-borderless table-hover tex">
          <thead>
            <tr>
              <th scope="col">#De Pedido</th>
              <th scope="col">Fecha </th>
              <th scope="col">Total a pagar</th>
              <th scope="col">Estado del pedido</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($datos as $productos) {
             ?>
            <tr>
              <th scope="row"><?php echo $productos['Id_Orden_Venta'];?></th>
              <td><?php echo $productos['Fecha'];?></td>
              <td>$<?php echo $productos['Costo_Total'];?></td>
              <td><?php echo $productos['Estatus'];?></td>
              <td>
              <a class="btn btn-dark btn-sm" href="detallespedido.php?id=<?php echo $productos['Id_Orden_Venta']?>"><i class="bi bi-eye"></i></a>
              </td>
              <td><button class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i></button> <button class="btn btn-danger btn-sm btn2"><i class="bi bi-trash"></i></button></td>
            </tr>
            <?php } ?>
          </tbody>
    </table>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>