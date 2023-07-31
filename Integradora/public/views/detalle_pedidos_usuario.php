<?php
require_once __DIR__ . '/../../src/Modelos/consultas_pedidos_usuarios.php';

use src\Config\Pedidos;

$productos = new Pedidos();

require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
$imagenes = new Imagenes();

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
$ID_ORDENVENTA=0;
$ID_USUARIO=0;

if(isset($_POST['id_ov'])){
    $ID_USUARIO = $_SESSION['usuario_id'];
    $ID_ORDENVENTA = $_POST['id_ov'];

    $datos = $productos->detallesorden($ID_USUARIO,$ID_ORDENVENTA);
}

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {
  $num_cart = count($_SESSION['carrito']['productos']);
}

$contador=0;
$total=0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel= "stylesheet" type= "text/css" herf= "http.//fonts.googleapis.com/css">
    <link rel= "stylesheet" href="../css/detalle_pedidos_usuario/styles.css">
   

</head>
<body>

<nav class="container-fluid">
        <!--Menu-->
        
        <label for="Nav-MenuBtn">
            <img src="../imagenes/menu.png" role="button" alt="" id="menu">
        </label>
        <input type="checkbox" id="Nav-MenuBtn">
        <!--Contenedor Del Usuario Y Carrito De Compras-->
        <div id="Contenedor-UC">
        <a href=""><img src="../imagenes/usuario.png" alt="" id="usuario"></a>
        <div id="ContCart">
            <a href="carritodecompras.php"><img src="../imagenes/carrito.png" alt="" id="carrito"></a>
            <span id="num_cart" class="badge bg-primary"><?php echo $num_cart; ?></span>
        </div>    
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
                <li><a href="catalogo.php">Inicio</a></li>
                <li><a href="catalogo.php">Catalogo</a></li>
                    <?php if($idUsuario == 1)
                    {
                        echo '<li><a href="pedidos.php">Pedidos</a></li>';
                    }
                    else 
                    {
                        echo '<li><a href="pedidos_usuario.php">Mis pedidos</a></li>';
                    }
                    ?>
                    <li><a href="cerrar_sesion.php">Cerrar sesion</a></li>
        </div>
    </nav>

    <div class="container detalle">
            <p class="fs-1 titulo-detalle">Detalle De Compra</p>
            <div class="table-responsive-sm">
                <table class="">
                    <thead id="theads" class="">
                        <tr>
                        <th scope="col">#</th>
                        <th class="text-center" colspan="2" scope="col">Producto</th>
                        <th class="text-center" scope="col">P/U</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th class="text-center" scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($datos as $res){ ?>
                    <?php   
                            $contador++;
                            $productimg = $res['imagen'];
                            $img = $imagenes->obtenerimag($productimg); 
                            $total+=$res['Precio_de_Venta']*$res['Cantidad'];
                    ?>
                        <tr>
                        <th class="align-middle" scope="row"><b><?php echo $contador; ?></b></th>
                        <td class="align-middle"><img src="<?php echo $img; ?>" alt=""></td>
                        <td class="align-middle"><b><?php echo $res['Nombre']; ?></b></td>
                        <td class="align-middle text-center"><?php echo "$".$res['Precio_de_Venta']; ?></td>
                        <td class="align-middle text-center"><?php echo $res['Cantidad'];?></td>
                        <td class="align-middle text-center"><?php echo "$".$res['Precio_de_Venta']*$res['Cantidad']; ?></td>
                        </tr>
                        <?php } ?>
                        <tfoot class="table-group-divider">
                        <tr>
                            <td id="to" colspan="6" class="text-end"><p id="t" class="fs-3">Total <?php echo "$".$total; ?></p></td>
                        </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
                
            </div>
        </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>