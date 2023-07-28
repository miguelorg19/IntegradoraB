<?php
require_once __DIR__. '/../../src/Modelos/consultascompras.php';

use src\Config\Compras;
$res='';
$num ='';
if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}
if (isset($_SESSION['ID_USUARIO'])) {
  
  header("location:login.php");
}
else{
  $idUsuario = $_SESSION['ID_USUARIO'];
}
$productos = new Compras();
if (isset($_SESSION['vacio'])) {
  $res = $_SESSION['vacio'];
}
if (isset($_SESSION['numeros'])) {
  $num = $_SESSION['numeros'];
}
if (isset($_SESSION['vacio']))
{
  $vac = $_SESSION['vacio'];
}
if (isset($_GET['categoria'])) {
  $categoriaSeleccionada = $_GET['categoria'];
  $resultado = $productos->consultarprod($categoriaSeleccionada);
  $res = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Compras</title>
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
      .con{
        margin-left:1%;
      }
      .cont{
        background-color:#f4f4f4;
        padding: 3%;
        border-radius: 2%;
        box-shadow: 0px 0px 1px 1px gray;
      }
      .conts{
        margin: 0 auto;
        margin-top: 10%;
      }
      .te{
            font-size: 1.3em;
            text-color:gray;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .tex{
          font-size: .9rem;
            text-color:gray;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .text{
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            font-size:2rem
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
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 cont mt-4">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 row">
      <div class="col-sm-6 col-md-6 col-lg-9 col-xl-9">
      <h1 class="text">Registro Compras</h1>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 ">
      <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo producto</button>
      <div class="modal modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="ti">Agregar producto</h1>
            </div>
            <div class="modal-body">
            <form action="../../src/Modelos/consultascompras.php" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control tex" aria-label="Amount (to the nearest dollar)" placeholder="Nombre(Obligatorio)" name="nombre">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Costo(Obligatorio)" name="costo" step="any">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Precio de venta(Obligatorio)" name="precio" step="any">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Cantidad(Obligatorio)" name="cantidad">
            <div class="mt-2">
              <textarea class="form-control" placeholder="Descripcion del producto" id="exampleFormControlTextarea1" rows="3" name="descripcion"></textarea>
            </div>
            <h2>Detalles</h2>
            <input type="text" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Marca(Obligatorio)" name="marca">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Tamaño(Opcional)" name="tamaño">
            <input type="text" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Color(Opcional)" name="color">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Cantidad por paquete(Obligatorio)" name="cantidadpaq">

            <div class="input-group mt-3">
              <span class="input-group-text tex" id="inputGroup-sizing-default">Categoria</span>
              <select class="form-select form-select-md tex" name="categoria" aria-label=".form-select-md example">
                <option selected>Seleccione(Obligatorio)</option>
                <option value="1">Escritura</option>
                <option value="2">Papel</option>
                <option value="3">Cuadernos</option>
                <option value="4">Archivo</option>
                <option value="5">Escolares</option>
              </select>
              </div>
              <h6 class="mt-2">Imagen(Obligatorio)</h6>
              <input type="file" name="img"  accept=".jpg, .jpeg, .png">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="guardar">Guardar</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <br/>
      <h5 class="te">Categoria</h5>
      <div class="input-group mt-3 ">
      <form action="registrocompras.php" class="input-group">
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
      </br>
      <h5 class="te">Producto</h5>
      <form action="../../src/Modelos/consultascompras.php" method="post">
       <div class="input-group mb-3 mt-3">
        <select class="form-select form-select-md tex" aria-label=".form-select-md example" name="producto" id="producto">
            <option selected>Seleccione el producto</option>
            <?php 
            foreach ($resultado as $producto) { 
                $ex = $producto['Existencias']?>
                <option value="<?php echo $producto['ID_productos'] ?>"><?php echo $producto['Prod'].',  '.$producto['Color'].',  Precio:$'.$producto['Precio_de_Venta'].', Existencias:' .$producto['Existencias'] ?></option>
            <?php } ?>
        </select>
    </div>
            </br>
      <h5 class="te">Cantidad</h5>
      <div>
      <input type="number" class="form-control tex" placeholder="Cantidad" aria-label="Recipient's username" aria-describedby="button-addon2" name="cantidad">
      </div>
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-outline-dark btn-md tex" value="Agregar" name="agregar">Agregar</button>
        </form>
      </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 cont table-responsive mt-4">
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#Producto</th>
              <th scope="col">Nombre</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Fecha</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      if (isset($_SESSION['Compras'])) {
                          foreach ($_SESSION['Compras'] as $index => $producto) {
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
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-3">
    <form action="../../src/Modelos/consultascompras.php" method="post">
    <button class="btn btn-outline-dark tex" name="confirmar" style="margin-right:3px;">Aceptar</button>
    </form>
    </div>
    
    </div>
 </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>