<?php

require_once '../../src/Config/conexion.php';
require_once '../../src/Modelos/imagenes.php';
use Src\Config\Conexion;
use Src\Config\Imagenes;


$imagenes = new Imagenes();

session_start();

if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}


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
        $sql = $con->prepare("SELECT ID_Productos, Nombre, Precio_de_Venta, $cantidad AS cantidad, Imagen FROM productos INNER JOIN imagenes on ID_Productos = producto_ID_producto WHERE ID_Productos = ?");
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
        
        body{
            display: flex;
            justify-content: center;
        }
    
        /*Inicia Menu*/
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
          padding: .6vh;
          padding-left: 2vh;
          padding-right: 2vh;
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
        /*Termina Menu*/
        

        
        
        

        .producto{
            display: flex;
            width: auto;
            border-radius: 2vh;
            padding: 2vh;
            background-color: #f4f4f4;
            margin-bottom: 2vh;
            box-shadow: 0px 5px 5px mediumslateblue;
        }

        .producto img{
            width: 20vh;
            height: 20vh;
        }

        .card{
            background-color: #f4f4f4;
            height: 20vh;
        }

        .detalles{
            width: 50%;
            padding-left: 1vh;
        }

        .nombre{
            font-weight: 600;
        }

        .precio{
            font-weight: 500;

        }

        .cantidad{
            display: flex;
            width:70%;
            z-index: 0;
        }

        

        
        #subtotal{
            margin-left: 2vh;
        }

        #ConBtnCon{
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        @media (width <= 995px){

            .contenedorC{
                display: flex;
                flex-direction: column;
            }

            #contenedor2{
                top: 0;
                width: 100%;
                padding-top: 8vh;
                left: 0;
            }


            #contenedor1{
                width: 94%;
                padding-top: 40vh;
            }

            .producto img{
                width: 15vh;
                height: 15vh;
            }

            .nombre{
                 font-size: 15px;
            }

            .precio{
                font-size: 14px;
            }

            #contenedorProductos{
            margin-top:25vh;
        
            }

            

        }

        
        @media (width <=768px){
            #Nav-MenuBtn:checked ~ #Menu-Desplegado{
                width: 100%;
            }

            .cantidad{
                width: 100%;
            }

            #contenedorProductos{
            padding: 2vh;
            margin-top:25vh;
        }

        @media (width <=426px){
            
            
            

            #contenedor1{
                padding-top: 30vh;
            }

            
        }

        }

        #contenedorCarrito{
            margin-top:8vh;
        }

        #contenedorProductos{
            padding: 2vh;
        }

        #contenedorTotal{
            height:30vh;
            padding: 2vh;
            position: fixed;
            right:0;
        }

        #cuadro{
            width: 100%;
            background-color: #f4f4f4;
            border-radius: 2vh;
            box-shadow: 0px 5px 5px gray;
            padding: 3vh;
        }

        #TC{
            display:flex;
            width:100%;
            justify-content:space-between;
            align-items:center;
        }

        #ContCart{
        display:flex;
        }

        #num_cart{
            height:2.5vh;
        }

        #cerrarSesion{
            width:100%;
            height:75%;
            display:flex;
            align-items:flex-end;
        }

        .eliminar{
            width:7vh;
        }

        .eliminar img{
            width:100%;
            height:100%;
        }

       

        .close img{
            width:3vh;
            height:3vh;
        }

        label{
            margin-bottom:0;
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
        <a href="usuario.php"><img src="../imagenes/usuario.png" alt="" id="usuario"></a>
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
                <li><a href="pedidos.php">Pedidos</a></li>
                <li><a href="cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
            </div>

            <div id="cerrarSesion">
                <a href="cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a>
            </div>
        </div>
    </nav>

<div id="contenedorCarrito" class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8" id="contenedorProductos">
            <div class="row">
                <?php
                    foreach($lista_productos as $p){
                        
                        $productimg = $p['Imagen']; 
                        $img = $imagenes->obtenerimag($productimg); 
                        $_id = $p['ID_Productos'];
                        $nombre = $p['Nombre'];
                        $precio = $p['Precio_de_Venta'];
                        $cantidad = $p['cantidad'];
                        $subtotal = $cantidad * $precio;
                        $total += $subtotal;
                        
                ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="producto">
                        <img src="<?php echo $img; ?>" alt="">
                        <div class="detalles">
                            <p class="nombre"><?php echo $nombre; ?></p>
                            <p class="precio">Precio: $<?php echo $precio; ?></p>
                            <p class="">Cantidad:</p>
                            
                                <div class="input-group cantidad">
                                    <button class="btn btn-outline-danger" onclick="disminuir(<?php echo $_id; ?>)">&minus;</button>
                                    <input class="form-control text-center" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)" type="number" min="1" value="<?php echo $_SESSION['carrito']['productos'][$_id]; ?>" id="cant_<?php echo $_id; ?>">
                                    <button class="btn btn-outline-success"  onclick="aumentar(<?php echo $_id; ?>)">&plus;</button>
                                    <button data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal"  class="btn btn-outline-dark eliminar"><img src="../imagenes/compartimiento.png" alt=""></button>
                                </div>
                        </div>
                        <div class="subtotal">
                            <h4>Subtotal</h4>
                            <div id="sub_<?php echo $_id; ?>" name="subtotal[]"><?php echo "$".number_format($subtotal,2,'.',','); ?></div>
                        </div>

                    </div>
                </div>

        
                
        <?php  } ?>

            </div>
        </div>

        <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-2" id="eliminarModal">Advertencia</h3>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"><img src="../imagenes/cerca.png" alt=""></button>
                </div>
                <div class="modal-body">
                    <p>¿Estas Seguro De Eliminar Este Producto Del Carrito De Compras?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-eliminar" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
                </div>
                </div>
            </div>
        </div>

        


        <div class="col-12 col-sm-12 col-md-12 col-lg-4" id="contenedorTotal">
            <div id="cuadro">
                <h4>Resumen De Compra</h4>
                <p>Cantidad De Producto(s): <?php echo $num_cart; ?></p>
                <hr/>
                <div id="TC">
                    <p id="Total">$<?php echo number_format($total,2,'.',','); ?></p>
                    <a href="confirmacion.php" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div> 

    </div>
</div>

    <script>
                let eliminarModal = document.getElementById('eliminarModal')
                eliminarModal.addEventListener('show.bs.modal', function(event){
                    let boton = event.relatedTarget
                    let id = button.getAttribute('data-bs-id')
                    let botonEliminar = eliminarModal.querySelector('.modal-footer #btn-eliminar')
                    botonEliminar.value = id

                })
                    

                    function eliminar(){
                        let boton = document.getElementById("btn-eliminar")
                        let id = boton.value


                      let url = 'actualizar_carrito.php';
                      let formData = new FormData()
                      formData.append('id',id)
                      formData.append('action','eliminar')

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

                    function actualizarCantidad(cantidad, id){
                      cantidad = parseInt(document.getElementById('cant_'+id).value);
                      
                      let url = 'actualizar_carrito.php';
                      let formData = new FormData()
                      formData.append('action','agregar')
                      formData.append('id',id)
                      formData.append('cantidad', cantidad)

                      fetch(url, {
                        method: 'POST',
                        body: formData,
                        mode: 'cors'
                      }).then(response => response.json())
                      .then(data => {
                        if(data.ok){

                            let subt = document.getElementById('sub_'+id);
                            let subtotal = data.sub;
                            subtotal = new Intl.NumberFormat('es-MX', {
                                minimumFractionDigits: 2
                            }).format(subtotal)

                            subt.innerHTML = "$" + subtotal;

                            let PrecioTotal = 0.00
                            let Lista  = document.getElementsByName('subtotal[]')

                            for (let i = 0; i < Lista.length; i++) {
                                 PrecioTotal += parseFloat(Lista[i].innerHTML.replace(/[$,]/g, ''))
                                
                            }

                            PrecioTotal = new Intl.NumberFormat('es-MX', {
                                minimumFractionDigits: 2
                            }).format(PrecioTotal)
                            

                            document.getElementById('Total').innerHTML = "$" + PrecioTotal;

                          

                        }
                      })
                    }              

                    function aumentar(id){
                        const cantidad = document.getElementById('cant_'+id).value++;
                        actualizarCantidad(cantidad,id);
                        
                    }

                    function disminuir(id){
                        if(document.getElementById('cant_'+id).value > 1){
                        const cantidad = document.getElementById('cant_'+id).value--;
                        actualizarCantidad(cantidad,id);
                        }
                    }

        

    </script>
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>
</html>
