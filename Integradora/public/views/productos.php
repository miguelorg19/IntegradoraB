<?php
require_once '../../src/Modelos/consultasproductos.php';
require_once '../../src/Modelos/imagenes.php';

use Src\Config\Productos;
use src\Config\Imagenes;

$productos = new Productos();
$imagenes = new Imagenes();
$datos = $productos->todos();
session_start();
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
 if($idUsuario != 1)
 {
   header("location:papemaxinicio.php");
 }

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
  <link href="/public/css/menucss.css" rel="stylesheet">
  <title>Agregar Producto</title>
  <style>
    .cos {
      margin: 0 auto;
      margin-top: 10%;
      background-color: #f4f4f4;
      border-radius: .5rem;
      box-shadow: 0px .5rem .5rem gray;
    }

    .coss {
      padding: 2rem;
    }

    .arch {
      font-family: 'Inter', sans-serif;
      font-size: 1rem;
      width: 100%;

    }

    .ti {
      font-family: 'Inter', sans-serif;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .img {
      width: 5rem;
      height: 5rem;
    }

    .contg {
      background-color: white;
      border-radius: .5rem;
    }

    .in {
      width: 100%;
      border-radius: .5rem;
      box-shadow: 0px .2rem .2rem gray;
    }

    .cop {
      margin: 0 auto;
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
  <div class="container col-xl-8 col-lg-8 col-sm-6 col-md-6 col-sm-12 col-12 row cos table-responsive conm">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Existencias</th>
          <th scope="col">Precio de venta</th>
          <th scope="col">Categoria</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($datos as $producto) {
            $productimg = $producto['Imagen'];
            $img = $imagenes->obtenerimag($productimg) ?>
          
        <tr>
          <td><?php echo $producto['ID_Productos']; ?></td>
          <td><?php echo $producto['Prod']; ?></td>
          <td><?php echo $producto['Descripcion']; ?></td>
          <td><?php echo $producto['Existencias']; ?></td>
          <td>$<?php echo $producto['Precio_de_Venta']; ?></td>
          <td><img src="<?php echo $img ?>" width="70%" height="70%"></td>
          <td><?php echo $producto['Cat']; ?></td>
          <td><button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $producto['ID_Productos']; ?>"><i class="bi bi-pencil-square"></i></button></td>
          <td><button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modaldel<?php echo $producto['ID_Productos']; ?>"><i class="bi bi-trash"></i></button></td>
        </tr>

        <div class="modal fade" id="exampleModal<?php echo $producto['ID_Productos']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="ti">Editar</h1>
              </div>
              <div class="modal-body">
                <form action="../../src/http/actualizar_producto.php" method="POST">
                  <input type="hidden" name="id_producto" value="<?php echo $producto['ID_Productos']; ?>">
                  <input type="text" class="form-control tex" name="nombre" aria-label="Amount (to the nearest dollar)" placeholder="Nombre" value="<?php echo $producto['Prod']; ?>">
                  <input type="number" class="form-control tex mt-2" name="precio" aria-label="Amount (to the nearest dollar)" placeholder="Precio de venta" value="<?php echo $producto['Precio_de_Venta']; ?> ">
                  <div class="input-group mt-3">
                    <span class="input-group-text tex" id="inputGroup-sizing-default">Categoria</span>
                    <select class="form-select form-select-md tex" aria-label=".form-select-md example" name="categoria">
                      <option value="1" <?php if ($producto['Cat'] == 'Escritura') echo 'selected'; ?>>Escritura</option>
                      <option value="2" <?php if ($producto['Cat'] == 'Papel') echo 'selected'; ?>>Papel</option>
                      <option value="3" <?php if ($producto['Cat'] == 'Cuadernos') echo 'selected'; ?>>Cuadernos</option>
                      <option value="4" <?php if ($producto['Cat'] == 'Archivo') echo 'selected'; ?>>Archivo</option>
                      <option value="5" <?php if ($producto['Cat'] == 'Escolares') echo 'selected'; ?>>Escolares</option>
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modaldel<?php echo $producto['ID_Productos']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="ti">Eliminacion</h1>
              </div>
              <div class="modal-body">
                <form action="../../src/http/borrarproducto.php" method="POST">
                  <h3>Esta seguro que desea eliminar?</h3>
                  <input type="hidden" name="id_producto" value="<?php echo $producto['ID_Productos']; ?>">
                  <input type="text" class="form-control mt-2 tex" name="nombre" aria-label="Amount (to the nearest dollar)" placeholder="Nombre" value="<?php echo $producto['Prod']; ?>" disabled>
                  <h6 class="mt-1">Existencias</h6>
                  <input type="text" class="form-control mt-2 tex" name="nombre" aria-label="Amount (to the nearest dollar)" placeholder="Nombre" value="<?php echo $producto['Existencias']; ?>" disabled>
                  <h6 class="mt-1">Precio de venta</h6>
                  <input type="text" class="form-control mt-2 tex" name="nombre" aria-label="Amount (to the nearest dollar)" placeholder="Nombre" value="<?php echo $producto['Precio_de_Venta']; ?>" disabled>
                  <div class="input-group">
                    <span class="input-group-text tex mt-2" id="inputGroup-sizing-default">Categoria</span>
                    <select class="form-select form-select-md tex mt-2" aria-label=".form-select-md example" name="categoria" disabled>
                      <option value="1" <?php if ($producto['Cat'] == 'Escritura') echo 'selected'; ?>>Escritura</option>
                      <option value="2" <?php if ($producto['Cat'] == 'Papel') echo 'selected'; ?>>Papel</option>
                      <option value="3" <?php if ($producto['Cat'] == 'Cuadernos') echo 'selected'; ?>>Cuadernos</option>
                      <option value="4" <?php if ($producto['Cat'] == 'Archivo') echo 'selected'; ?>>Archivo</option>
                      <option value="5" <?php if ($producto['Cat'] == 'Escolares') echo 'selected'; ?>>Escolares</option>
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Si eliminar</button>
              </div>
              </form>
            </div>
          </div>
        <?php } ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>