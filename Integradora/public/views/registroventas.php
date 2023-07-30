<?php
require_once __DIR__ . '/../../src/Modelos/consultasventas.php';
require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
use src\Config\Ventas;
$res = '';
$Pago = 0;
$imagenes = new Imagenes();
$productos = new Ventas();
if (isset($_SESSION['usuario_nombre'])) {
  $nombreus = $_SESSION['usuario_nombre'];
} else {
  header("location:login.php");
}
if (isset($_SESSION['usuario_id'])) {
  $idUsuario = $_SESSION['usuario_id'];
} else {
  header("location:login.php");
}


if (isset($_SESSION['resultado'])) {
  $res = $_SESSION['resultado'];
}

if (isset($_GET['categoria'])) {
  $categoriaSeleccionada = $_GET['categoria'];
  $resultado = $productos->consultarprod($categoriaSeleccionada);
  $res = false;
}
if (isset($_GET['PagoTotal'])) {
  $Pago = $_GET['PagoTotal'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Ventas</title>
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
    .con {
      margin-left: 1%;
    }

    .msj {
      font-size: 1rem;
      text-color: gray;
      font-family: 'Inter', sans-serif;
      font-weight: bold;
    }

    .cont {
      background-color: #f4f4f4;
      padding: 3%;
      border-radius: 2%;
      box-shadow: 0px 0px 1px 1px gray;
    }

    .conts {
      margin: 0 auto;
      margin-top: 5%;
    }

    .te {
      font-size: 1.3em;
      text-color: gray;
      font-family: 'Inter', sans-serif;
      font-weight: bold;
    }

    .text {
      font-family: 'Inter', sans-serif;
      font-weight: bold;
    }

    .tex {
      font-size: .9rem;
      text-color: gray;
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
      <!--Contenedor Del Usuario Y Carrito De Compras-->
      <div id="Contenedor-UC">
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
        <a href="usuario.php"><img src="<?php echo $img ?>" alt="" id="usuario"></a>
     
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
            <li>
              <a href="registroventas.php">Registro de ventas</a>
            </li>
            <li>
              <a href="registrocompras.php">Registro de compras</a>
            </li>
            <li>
              <a href="ventasdiarias.php">Ventas diarias</a>
            </li>
            <li>
              <a href="reportemensual.php">Ventas mensuales</a>
            </li>
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

  <div class="container-fluid conts row justify-content-around">
    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7 cont mt-4">

      <h1 class="text">Registro Ventas</h1>
      <br />
      <h5 class="te">Categoria</h5>
      <div class="input-group mt-3 ">
        <form action="registroventas.php" class="input-group">
          <select class="form-select form-select-md tex" aria-label=".form-select-md example" name="categoria" id="categoria">
            <option selected>Seleccione</option>
            <option value="Escritura">Escritura</option>
            <option value="Papel">Papel</option>
            <option value="Cuadernos">Cuadernos</option>
            <option value="Archivo">Archivo</option>
            <option value="Escolares">Escolares</option>
          </select>
          <button type="submit" class="input-group-text tex" id="inputGroup-sizing-default">Buscar</button>
        </form>
      </div>
      <br />
      <h5 class="te">Producto</h5>
      <form action="../../src/Modelos/consultasventas.php" method="post">
        <div class="input-group mb-3 mt-3">
          <select class="form-select form-select-md tex" aria-label=".form-select-md example" name="producto" id="producto">
            <option selected>Seleccione el producto</option>
            <?php
            foreach ($resultado as $producto) {
              $ex = $producto['Existencias'] ?>
              <option value="<?php echo $producto['ID_productos'] ?>"><?php echo $producto['Prod'] . ' ' . $producto['Color'] . ',  Precio:$' . $producto['Precio_de_Venta'] . ', Existencias:' . $producto['Existencias'] ?></option>
            <?php } ?>
          </select>
        </div>
        <h5 class="te">Cantidad</h5>
        <div>
          <input type="number" class="form-control tex" placeholder="Cantidad" aria-label="Recipient's username" aria-describedby="button-addon2" name="cantidad">
        </div>
        <?php if ($res == true) {
          $productos->avisos();
        } ?>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-3">
          <button type="submit" class="btn btn-outline-dark btn-md tex" value="Agregar" name="agregar">Agregar</button>
      </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 cont table-responsive mt-4">
      <table class="table table-hover tex">
        <thead>
          <tr>
            <th scope="col">#Producto</th>
            <th scope="col">Nombre del producto </th>
            <th scope="col">Cantidad</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_SESSION['Ventas'])) {
            foreach ($_SESSION['Ventas'] as $index => $producto) {
              echo "<tr>";
              echo "<th scope='row'>" . ($index + 1) . "</th>";
              echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
              echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
              echo "<td>" . htmlspecialchars($producto['fecha']) . "</td>";
              echo "<td>$" . htmlspecialchars($producto['totalven']) . "</td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 cont mt-4">
    <div class="mt-3">
      <h6 class="te">Metodo de pago:</h6>
      <input type="text" class="form-control tex" placeholder="Efectivo" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
      <br>
      <div class="input-group input-group-md mb-3 mt-3">
        <form action="registroventas.php" class="input-group">
          <span class="input-group-text tex">$</span>
          <input type="text" class="form-control tex" aria-label="Amount (to the nearest dollar)" placeholder="Pago con" name="PagoTotal">
          <span class="input-group-text tex">.00</span>
          <button class="btn btn-outline-dark tex" name="confirmar">Calcular</button>
        </form>
      </div>
      <br>
      <h5 class="te">Total:</h5>
      <?php
      if (isset($_SESSION['Ventas'])) {
        foreach ($_SESSION['Ventas'] as $producto) ?>
        <h6 class="tex">$<?php echo $producto['total'] ?></h6>
      <?php } ?>
      <br>
      <h5 class="te">Cambio: </h5>
      <?php
      if (isset($_SESSION['Ventas'])) {
        foreach ($_SESSION['Ventas'] as $producto) ?>
        <h6 class="tex">$<?php if ($Pago > $producto['total']) {
                            echo $Pago - $producto['total'];
                          } else {
                            echo 'Ingrese un monto mayor a su total';
                          } ?></h6>
      <?php } ?>
      <br>
      <br>
      <div class="d-flex flex-row-reverse col-12">
        <form action="../../src/Modelos/consultasventas.php" method="post">
          <button class="btn btn-outline-danger tex" name="cancelar">Cancelar</button>
        </form>
        <form action="../../src/Modelos/consultasventas.php" method="post">
          <button class="btn btn-outline-dark tex" name="confirmar" style="margin-right:3px;">Aceptar</button>
        </form>
      </div>
      </br>
      <div class="d-flex flex-row-reverse col-12">
        <a href="ventasdiarias.php" class="btn btn-dark tex">Ver mis ventas diarias</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>