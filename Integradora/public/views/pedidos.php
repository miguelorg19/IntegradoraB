<?php
require_once __DIR__ . '/../../src/Modelos/consultaspedidos.php';
require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
$imagenes = new Imagenes();
use src\Config\Pedidos;

$productos = new Pedidos();
$datos = $productos->orden();
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
  <link href="/public/css/menucss.css" rel="stylesheet">
  <style>
    .pw {
      margin: 0 auto;
      margin-top: 10%;
      background-color: #f4f4f4;
      border-radius: .5rem;
      padding: 1rem;
      border: 1px solid black;
      box-shadow: 0px .3rem .3rem gray;

    }

    .contenido {
      background-image: url('../imagenes/papeleriapedidos.jpg');

      height: 100%;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    }

    .tex {
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
      font-weight: bold;
    }

    .te {
      font-size: 2.5rem;
      text-color: gray;
      font-family: 'Inter', sans-serif;
      font-weight: bold;
    }

    @media (min-width: 200px) and (max-width: 400px) {
      .btn2 {
        margin-top: 5%;
      }
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
            if(!empty($foto)){
              $url = $foto;
              $img = $imagenes->obtenerimaus($url);
            }
            else{
              $img = '../imagenes/usuario.png';
            }
            ?>
      <div id="Contenedor-UC">
        <a href="usuario.php"><img src="../imagenes/usuario.png" alt="" id="usuario"></a>
        
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
            <?php if($idUsuario == 1)
            {
            echo '<li><a href="registroventas.php">Registrar Ventas</a></li>'.
            '<li><a href="registrocompras.php">Registrar compras</a></li>'.
            '<li><a href="ventasdiarias.php">Ventas diarias</a></li>'.
            '<li><a href="reportemensual.php">Ventas mensuales</a></li>';
            }?>
              <a href="pedidos.php">Pedidos</a>
            </li>
            <li><a href="cerrar_sesion.php">Cerrar Sesion</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </div>

  <div class="contenido">

    <img style="height: 100%; width:100%;" src="../imagenes/papeleriapedidos.jpg" alt="" id="home">

  </div>


  <div class="container table-responsive d-flex justify-content-center row pw col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12 esp">
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
          <?php foreach ($datos as $productos) {
          ?>
            <tr>
              <th scope="row"><?php echo $productos['Id_Orden_Venta']; ?></th>
              <td><?php echo $productos['Fecha']; ?></td>
              <td>$<?php echo $productos['Costo_Total']; ?></td>
              <td><?php echo $productos['Estatus']; ?></td>
              <td>
                <a class="btn btn-dark btn-sm" href="detallespedido.php?id=<?php echo $productos['Id_Orden_Venta'] ?>"><i class="bi bi-eye"></i></a>
              </td>
              <td class="status"><?php echo $productos['Estatus']; ?></td>
              <td>
                <a class="btn btn-dark btn-sm" href="detallespedido.php?id=<?php echo $productos['Id_Orden_Venta'] ?>"><i class="bi bi-eye"></i></a>
              </td>
              <td>
                <button class="btn btn-success btn-sm btn-success-btn" data-orden-id="<?php echo $productos['Id_Orden_Venta']; ?>">
                  <i class="bi bi-check-lg"></i>
                </button>
                <?php if ($productos['Estatus'] !== 'REALIZADO') { ?>
                  <button class="btn btn-danger btn-sm btn-delete"><i class="bi bi-trash"></i></button>
                <?php } ?>
              </td>
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