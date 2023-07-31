<?php
require_once __DIR__ . '/../../src/Modelos/consultas_pedidos_usuarios.php';
require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
use src\Config\Pedidos;

$productos = new Pedidos();
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

$ID_USUARIO = $_SESSION['usuario_id'];
if($ID_USUARIO != 1)
{
 $datos = $productos->orden($ID_USUARIO);
}
$contador=0;

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {
  $num_cart = count($_SESSION['carrito']['productos']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../css/pedidos_usuario/styles.css" rel="stylesheet">       


</head>
<body>

<nav class="container-fluid">
        <!--Menu-->
        
        <label for="Nav-MenuBtn">
            <img src="../imagenes/menu.png" role="button" alt="" id="menu">
        </label>
        <input type="checkbox" id="Nav-MenuBtn">
        <!--Contenedor Del Usuario Y Carrito De Compras-->
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
        <a href="usuario.php"><img src="<?php echo $img ?>" alt="" id="usuario"></a>
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
                <li><a href="papemaxinicio.php">Inicio</a></li>
                <li><a href="catalogo.php">Catalogo</a></li>
                <?php if($idUsuario == 1)
                            {
                            echo '<li><a href="registroventas.php">Registrar Ventas</a></li>'.
                            '<li><a href="registrocompras.php">Registrar compras</a></li>'.
                            '<li><a href="ventasdiarias.php">Ventas diarias</a></li>'.
                            '<li><a href="reportemensual.php">Ventas mensuales</a></li>';
                            }?>
                <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>      
            </ul>
            </div>
        </div>
</nav>
    

    <div class="container ordenes">
        <div class="">
            <p class="fs-2 titulo-pedidos">Historial De Pedidos</p>
            <table class="">
                <thead class="">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Folio</th>
                    <th scope="col">Total</th>
                    <th class="text-center" scope="col">Estatus</th>
                    <th class="text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $res){ $contador++; ?>
                    <tr>
                    <th class="align-middle" scope="row"><?php echo $contador; ?></th>
                    <td class="align-middle"><?php echo $res['Folio']; ?></td>
                    <td class="align-middle"><?php echo "$".$res['Costo_Total']; ?></td>
                    <td class="align-middle text-center">
                    <?php switch($res['Estatus']){
                        case 'PENDIENTE':
                            echo "<p style='color:white;'>PENDIENTE</p>";
                            break;

                        case 'CANCELADO':
                            echo "<p style='color:#fc2128;'>CANCELADO</p>";
                            break;

                        case 'REALIZADO':
                            echo "<p style='color:#42f554;'>REALIZADO</p>";
                            break;
                    }
                    
                    ?></td>
                    <td class="align-middle" colspan="2">
                        <div class="row">
                            <form action="detalle_pedidos_usuario.php" method="POST" id="ver" class="col-lg-2 col-4">
                                <button type="submit" class="btn btn-outline-light" value="<?php echo $res['Id_Orden_Venta']; ?>" name="id_ov"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <button data-bs-id="<?php echo $res['Folio']; ?>" data-bs-toggle="modal" data-bs-target="#cancelarModal" id="cancelar" class="col-lg-9 col-7 btn btn-outline-danger">Cancelar</button>
                        </div>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-2" id="cancelarModal">Advertencia</h3>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"><img id="cerrar" src="../imagenes/cerca.png" alt=""></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5">¿Estas Seguro De Cancelar El Pedido?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-cancelarp" type="button" class="btn btn-danger" onclick="cancelar()">Cancelar Pedido</button>
                </div>
                </div>
            </div>
        </div>

    <script>
        let cancelarModal = document.getElementById('cancelarModal')
                cancelarModal.addEventListener('show.bs.modal', function(event){
                    let boton = event.relatedTarget
                    let folio = boton.getAttribute('data-bs-id')
                    let botonEliminar = cancelarModal.querySelector('.modal-footer #btn-cancelarp')
                    botonEliminar.value = folio

                })
                    

                    function cancelar(){
                        let boton = document.getElementById("btn-cancelarp")
                        let folio = boton.value


                      let url = '../../src/Modelos/cancelar_pedido.php';
                      let formData = new FormData()
                      formData.append('folio',folio)

                      fetch(url, {
                        method: 'POST',
                        body: formData,
                        mode: 'cors'
                      }).then(response => response.json())
                      .then(data => {
                        if(data.ok){
                          location.reload();
                        }
                      })
                    }  
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>