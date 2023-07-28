<?php

require_once '../../src/Config/conexion.php';
require_once '../../src/Modelos/imagenes.php';


use src\Config\Conexion;
use src\Config\Imagenes;


$imagenes = new Imagenes();

session_start();
if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}
if (isset($_SESSION['ID_USUARIO'])) {
  
  header("location:login.php");
}
else{
  $idUsuario = $_SESSION['ID_USUARIO'];
}

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {
  $num_cart = count($_SESSION['carrito']['productos']);
}

$db = new Conexion();
$con = $db->conectar();



$sql = $con->prepare("SELECT ID_Productos, Nombre, Precio_de_Venta, Imagen FROM productos INNER JOIN imagenes on ID_Productos = producto_ID_producto;");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['Producto'])) {
  $nombre = $_GET['Producto'];
  $query = "SELECT ID_Productos, Nombre, Precio_de_Venta FROM productos WHERE Nombre LIKE '%" . $nombre . "%'";

  $sql = $con->prepare($query);
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  $con = null;
  $sql = null;
}

?>

<?php
require_once '../../src/Modelos/filtro.php';

use src\Modelos\Filtro;

$categorias = new Filtro();
$query = "SELECT ID_Productos, Nombre, Precio_de_Venta, Imagen FROM productos INNER JOIN imagenes ON productos.ID_Productos = imagenes.producto_ID_producto";

if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
  $categoria_id = $_GET['categoria'];
  $query .= " WHERE Categorias_ID_Categorias = :categoria_id";
}

if (isset($_GET['precio_min']) && is_numeric($_GET['precio_min'])) {
  $precio_min = $_GET['precio_min'];
  $query .= " AND Precio_de_Venta >= :precio_min";
}

if (isset($_GET['precio_max']) && is_numeric($_GET['precio_max'])) {
  $precio_max = $_GET['precio_max'];
  $query .= " AND Precio_de_Venta <= :precio_max";
}

$sql = $con->prepare($query);

if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
  $sql->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
}

if (isset($_GET['precio_min']) && is_numeric($_GET['precio_min'])) {
  $sql->bindParam(':precio_min', $precio_min, PDO::PARAM_INT);
}

if (isset($_GET['precio_max']) && is_numeric($_GET['precio_max'])) {
  $sql->bindParam(':precio_max', $precio_max, PDO::PARAM_INT);
}

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalogo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/catalog_styles/styles.css">

  <style>
    #Buscar {
      width: 2.5vh;
      height: 2.5vh;
    }





    #Buscador {
      border-top-left-radius: 1vh;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 1vh;
    }

    #M {
      display: none;
    }

    #ContCart {
      display: flex;
    }

    #num_cart {
      height: 2.5vh;
      text-align: center;
    }

    .details {
      width: 100%;
    }

    .img {
      width: 9.2rem;
      height: 9.2rem;
      filter: brightness(1.1);
      mix-blend-mode: multiply;
      margin: 0 auto;
      margin-top: .5rem;
    }

    .ti {
      font-size: .9rem;
      text-color: gray;
      font-family: 'Inter', sans-serif;
      font-weight: bold;

    }



    #Contenedor-Catalogo {
      width: 100%;
      height: 100%;
      margin-top: 8vh;
    }



    #lateral {
      position: fixed;
      left: 0;
      height: 100%;
      background: black;
      transition: .5s;
      padding: 2vh;
    }

    #productos {
      position: absolute;
      right: 0;
      padding: 2vh;
    }

    #B2 {
      display: none;
    }




    @media(width<768px) {
      #lateral {
        transition: .5s;
        left: -100vh;
        z-index: 1;
      }

      #M:checked~#lateral {
        left: 0;
      }
    }

    @media(width < 767px) {

      #B1 {
        display: none;
      }

      #B2 {
        width: 36vh;
        display: flex;
      }

    }

    #Jacky {
      font-size: 28px;
    }

    #Jacky {
      background: -webkit-linear-gradient(45deg, #ff9500, #b300ff, rgb(251, 42, 255));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: bold;
    }

    #ContUs {
      display: flex;
      align-items: center;
    }

    .filter-btn {
      background-color: #f4f4f4;
     
      box-shadow: 0px 2px 10px rgba(100, 100, 100, 0.5);
      color: #000;
      transition: background-color 0.3s, color 0.3s;
    }

   
    .filter-btn:hover {
      background-color: #000;
      color: #fff;
    }

    .link {
      cursor: pointer;
      color: white;
    }


    .filter-content {
      display: none;
      position: absolute;
      background: #293133;
     
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 10px;
      z-index: 1;
      width: 300px; 
      height: auto;
    }

    .formfil {
      display: flex;
      flex-direction: column;
      height: auto;
    }


    .filter-content select,
    .filter-content label,
    .filter-content input {
      width: 100%;
      height: 50px;
      margin-bottom: 10px;
    }

    #toggle-filter:checked+.filter-content {
      display: flex;
      flex-direction: column;
      background-color: black;
      box-shadow: 0px 2px 10px rgba(100, 100, 100, 0.5);
      height: auto;
      padding: 15px;
      margin-top: 5px;
    }


    .filter-label:hover {
      color: #b300ff;
    }

    .option {
      height: 20%;
      width: 50%;
    }
  </style>
</head>

<body>

  <nav class="container-fluid">
    <label for="M">
      <img role="button" src="../imagenes/menu.png" id="menu" alt="">
    </label>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="B1" class="btn-group">
      <input type="text" placeholder="Buscar" id="Buscador" name="Producto" class="form-control">
      <button class="btn btn-light" type="submit" id="BtnBuscar">
        <img src="../imagenes/busqueda.png" id="Buscar" alt="">
      </button>
    </form>
    <div id="Contenedor-UC">
      <div id="ContUs">
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
        <a href=""><img src="<?php $img ?>" id="usuario" alt=""></a>
        <h2><?php //echo $_SESSION["Nombre"]; 
            ?></h2>
      </div>
      <div id="ContCart">
        <a href="carritodecompras.php">
          <img src="../imagenes/carrito.png" id="carrito" alt="">
        </a>
        <span id="num_cart" class="badge bg-primary"><?php echo $num_cart; ?></span>

      </div>
    </div>
  </nav>



  <div class="container-fluid" id="Contenedor-Catalogo">
    <div class="row">
      <input type="checkbox" id="M">
      <div class="col-md-4 col-lg-3" id="lateral">
        <p id="Jacky">Jacky Papeleria</p>
        <div id="Nav-Items">
          <ul>
            <li><a href="papemaxinicio.php">Inicio</a></li>

            <li class="col">
              <label for="toggle-filter" class="filter-label link">Filtro</label>
              <input type="checkbox" id="toggle-filter">

              <div class="filter-content">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="filtroForm" class="btn-group formfil">
                  <select name="categoria" class="form-control">
                    <option class="option" value="">Todas las categorías</option>
                    <?php
                    $categorias = $categorias->obtenerCategorias();
                    foreach ($categorias as $categoria) {
                      echo '<option value="' . $categoria['Id_Categorias'] . '">' . $categoria['Nombre'] . '</option>';
                    }
                    ?>
                  </select>

                  <label class="text-light" for="precio_min">Precio mínimo:</label>
                  <input type="number" name="precio_min" id="precio_min" class="form-control mb-5" step="1">
                  <label class="text-light"  for="precio_max">Precio máximo:</label>
                  <input type="number" name="precio_max" id="precio_max" class="form-control mb-5" step="1">
                  <button type="submit" class="btn filter-btn">Aplicar filtro</button>
                </form>
              </div>
            </li>
            <li>
              <a href="pedidos_usuario.php">Pedidos</a>
            </li>

            <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>

            <br>

          </ul>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-9" id="productos">
        <h2>Productos</h2>
        <div class="row">
          <?php foreach ($resultado as $res) {
          ?>
            <div class="col-6 col-sm-4 col-md-6 col-lg-4 col-xl-3 producto">
              <div class="card">
                <?php
                $productimg = $res['Imagen'];
                $img = $imagenes->obtenerimag($productimg); ?>
                <img src="<?php echo $img ?>" class="card-img-top img" alt="...">
                <div class="card-body">
                  <h5 class="card-title ti"><?php echo $res['Nombre']; ?></h5>
                  <p class="card-text"><?php echo "$" . $res['Precio_de_Venta']; ?></p>
                  <a href="producto.php?id=<?php echo $res['ID_Productos']; ?>" class="btn btn-primary details">Detalles</a>

                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>




  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>
