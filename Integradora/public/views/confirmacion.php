<?php

require '../../src/Config/database.php';

session_start();

if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}

$contador = 0;


$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
$num_cart = count($_SESSION['carrito']['productos']);
}

$db = new Conexion();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_productos = array();
$total = 0;

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT ID_Productos, Nombre, Precio_de_Venta, $cantidad AS cantidad FROM Productos WHERE ID_Productos = ?");
        $sql->execute([$clave]);
        $lista_productos[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  

    <style>
        /*Inicia Menu*/
        label{
            margin-bottom:0;
        }
        
        #menu{
          width: 6vh;
          height: 6vh;
        }
        h3{
          font-size: 30px;
          background: -webkit-linear-gradient(45deg,#ff9500, #b300ff,rgb(251, 42, 255));
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent; 
          font-weight: bold;
        }
        
        
        #Cerrar{
          width: 4vh;
          height: 4vh;
        }
        
        nav{
          background-color: black;
          display: flex;
          justify-content: space-between;
          align-items: center;
          position: fixed;
          width: 100%;
          height: 8vh;
          z-index: 1;
        }

        #Nav-MenuBtn{
            display: none;
        }
       
        #Menu-Desplegado{
            width: 50vh;
            transition: 2s;
            height: 100%;
            position: fixed;
            top: 0;
            left: -100vh;
            z-index: 2;
            background-color: black;
            padding: 2vh;
        }
        #Contenedor-Menu-Desplegado{
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        #Nav-MenuBtn:checked ~ #Menu-Desplegado{
            left: 0;
            transition: .5s;
        }
        
        #usuario{
          background-color: white;
          width: 6vh;
          height: 6vh;
          border-radius: 3vh;
          border: .5vh solid white;
        }
        #Buscar{
            width: 3vh;
            height: 3vh;
            position: relative;
            right: 5vh;
            bottom: .2vh;

        }

        #Buscador{
            width: 15em;
            height: 2.5em;
            border-radius: 3vh;
            border: none;
            padding: 10px;
        }

        #Nav-Items{
            margin-top: 3vh;
        } 

        #Nav-Items a{
            transition: .3s;
            text-decoration: none;
            color: white;
            font-weight: 400;
            font-size: 18px;
        }

        #Nav-Items a:hover{
            color: #b300ff;
            transition: .3s;
            margin-left: 1vh;
        }
        
        #Nav-Items ul li{
            list-style: none;
            margin-bottom: 2vh;
            margin-left: -4vh;
        }
        
        #Contenedor-UC{
            display: flex;
            justify-content: space-between;
            width: 14vh;
        }

        #carrito{
            width: 6vh;
            height: 6vh;
        }

        #ContCart{
        display:flex;
        }

        #num_cart{
            height:2.5vh;
        }

        @media (width < 768px){
            #Nav-MenuBtn:checked ~ #Menu-Desplegado{
                width: 100%;
            }
        }
        /*Termina Menu*/

        #Contenedor-Confirmacion{
            width:100%;
            height:80vh;
            position:absolute;
            margin-top:8vh;
            padding-top:2vh;
        }

        .container{
            padding:2vh;
            background:#f4f4f4;
            border-radius:2vh;
            border:2px solid black;
        }

        #cabecera{
            background:black;
        }

        #C-Btns{
            display:flex;
            justify-content: space-between;
        }

        .total{
            background: -webkit-linear-gradient(45deg,violet, red,orange);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent; 
          font-weight: bold;
        }

        .close img{
            width:3vh;
            height:3vh;
        }

    </style>
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
                    <a href=""><img src="../imagenes/carrito.png" alt="" id="carrito"></a>
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
                    <li><a href="">Filtro</a></li>
                    <li><a href="">Categorias</a></li>
                </ul>
                </div>

                <div id="cerrarSesion">
                    <a href="cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a>
                </div>
            </div>
    </nav>

    <div class="container-fluid" id="Contenedor-Confirmacion">
        <div class="container">
            <h3>Carrito De Compras</h3>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead id="cabecera">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio/U</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($lista_productos as $p){
                        $contador++;

                        $_id = $p['ID_Productos'];
                        $nombre = $p['Nombre'];
                        $precio = $p['Precio_de_Venta'];
                        $cantidad = $p['cantidad'];
                        $subtotal = $cantidad * $precio;
                        $total += $subtotal;

                        
                    ?>
                        <tr>
                        <th scope="row"><?php echo $contador; ?></th>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo "$".$precio; ?></td>
                        <td class="text-center"><?php echo $cantidad; ?></td>
                        <td><?php echo "$".$subtotal; ?></td>

                        </tr>

                        <?php } ?>
                        <tr>
                            <td class="text-end" colspan="5"><p class="fs-1 total">Total: <?php echo "$".$total; ?></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="C-Btns">
                <a href="carritodecompras.php" class="btn btn-outline-info">Editar Pedido</a>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmarModal">Confirmar Pedido</a>
            </div>
            <div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="confirmarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-2" id="confirmarModal">Confirmar</h3>
                            <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"><img src="../imagenes/cerca.png" alt=""></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estas Seguro De Realizar El Pedido?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="confirmar(<?php echo $total; ?>)">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmar(total){
            let url = 'confirmacion_pedido.php';
            formData = new FormData();
            formData.append('total',total);
            formData.append('action','confirmado');


            fetch(url, {
                        method: 'POST',
                        body: formData,
                        mode: 'cors'
                      }).then(response => response.json())
                      .then(data => {
                        if(data.ok){
                            location.replace('catalogo.php');
                        }
                      })
        }
    </script><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>