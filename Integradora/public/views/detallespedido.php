<?php
require_once '../../src/modelos/consultaspedidos.php';
require_once '../../src/modelos/imagenes.php';
use Src\Config\Pedidos;
use Src\Config\Imagenes;
$productos = new Pedidos();
$imagenes = new Imagenes();
$id = $_GET['id'];
$datos = $productos->detallesorden($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del pedido</title>
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
        .conss{
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: .5rem;
            padding: 1rem;
            box-shadow: 0px .3rem .3rem gray;
        }
        .imgs{
            width:9.2rem;
            height:9.2rem;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
        }
        .conn{
            padding:0.5rem;
        }
        .conn2{
            padding:0.5rem;
        }
        .text{
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .te{
            font-size: 1.1rem;
            text-color:gray;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
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
                        <li>
                        <a class="dropdown-item" href="agregarproducto.php">Agregar producto</a>
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
        <div class="container col-8 mt-4 row conss d-flex justify-content-center">
                <h1 class="text">Detalles del pedido</h1>
                <hr>
                <?php 
                foreach ($datos as $detalles) { ?>
                    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12 conn">
                        <?php                 $productimg = $detalles['imagen'];
                        $img = $imagenes->obtenerimag($productimg)?>
                        <img src='<?php echo $img?>' class="imgs img-thumbnail">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 conn2">
                        <h3 class="te"><?php echo $detalles['Nombre'] ?></h3>
                        <h3 class="te"><?php echo $detalles['Cantidad'] ?></h3>
                        <?php
                        $productId = $detalles['ID_productos'];
                        $idVe = $detalles['Id_Detalle_orden_Venta'];
                        $total = $productos->tot($idVe, $productId);
                        ?>
                        <h3 class="te">$<?php echo $total ?></h3>
                    </div>
                    <hr class="mt-2">
                <?php } ?>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>