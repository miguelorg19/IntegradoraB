<?php
require_once '../../src/Modelos/consultaspedidos.php';
require_once '../../src/Modelos/imagenes.php';
use src\Config\Pedidos;
use src\Config\Imagenes;
$productos = new Pedidos();
$imagenes = new Imagenes();
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: pedidos.php");
    exit(); 
}


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
    <link href="/public/css/menucss.css" rel="stylesheet">
    <style>

        .conss{
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: .5rem;
            padding: 1rem;
            margin-top: 10%;
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
<div class="navcont">
    <nav>
      <!--Menu-->

      <label for="Nav-MenuBtn">
        <img src="../imagenes/menu.png" role="button" alt="" id="menu">
      </label>

      <input type="checkbox" id="Nav-MenuBtn">

      <?php
      $foto = $imagenes->verfoto($idUsuario);
      if (!empty($foto)) {
        $url = $foto;
        $img = $imagenes->obtenerimaus($url);
      } else {
        $img = '../imagenes/usuario.png';
      }
      ?>
      <div id="Contenedor-UC">
        <a href="usuario.php"><img src="<?php echo $img ?>" alt="" id="usuario"></a>
        <a href="carritodecompras.php"><img src="../imagenes/carrito.png" alt="" id="carrito"></a>
      </div>
      <!--Menu Desplegado-->
      <div id="Menu-Desplegado">
        <div id="Contenedor-Menu-Desplegado">
          <h3>Jacky Papeleria</h3>
          <label for="Nav-MenuBtn">
            <img src="../imagenes/cerca.png" role="button" alt="" id="Cerrar">
          </label>
        </div>

        <div id="Nav-Items">
          <ul>
            <li>
              <a href="papemaxinicio.php">Inicio</a>
            </li>
            <li>
              <a href="catalogo.php">Catalogo</a>
            </li>
            <?php if ($idUsuario == 1) {
              echo '<li><a href="registroventas.php">Registrar Ventas</a></li>' .
                '<li><a href="registrocompras.php">Registrar compras</a></li>' .
                '<li><a href="ventasdiarias.php">Ventas diarias</a></li>' .
                '<li><a href="reportemensual.php">Ventas mensuales</a></li>';
            } ?>
            <li>
              <a href="pedidos.php">Pedidos</a>
            </li>


            <li><a href="cerrar_sesion.php">Cerrar Sesion</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </div>
        <div class="container col-8 fff row conss d-flex justify-content-center">
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
                        $idVe = $detalles['Orden_Ventas_Id_Orden_Venta'];
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