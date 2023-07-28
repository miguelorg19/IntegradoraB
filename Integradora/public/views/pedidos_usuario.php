<?php
require_once __DIR__ . '/../../src/Modelos/consultas_pedidos_usuarios.php';

use src\Config\Pedidos;

$productos = new Pedidos();

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

$ID_USUARIO = $_SESSION['ID_USUARIO'];
 $datos = $productos->orden($ID_USUARIO);

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

  #Jacky{
    background: -webkit-linear-gradient(45deg,#ff9500, #b300ff,rgb(251, 42, 255));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; 
    font-weight: bold;
  }

  .main{
    transition: .5s;
      position: fixed;
      padding: 1vh;
      left: 0;
      top: 8%;
      width: 20%;
      height: 92%;
      background-color: black;
      z-index: 1;
  }

  #Cerrar{
    width: 4vh;
    height: 4vh;
  }
  
  nav{
    background-color: transparent;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 8vh;
    z-index: 1;
    background-color: black;
  }

  #usuario{
    background-color: white;
    width: 6vh;
    height: 6vh;
    border-radius: 3vh;
    border: .5vh solid white;
  }
  

 

  #Nav-Items{
      margin-top: 3vh;
      margin-left: -3vh;
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
  }
  
  #Contenedor-UC{
      display: flex;
      justify-content: space-between;
      width: 15vh;
  }

  #carrito{
      width: 6vh;
      height: 6vh;
  }

  #ContCart {
      display: flex;
    }

    #num_cart {
      height: 2.5vh;
      text-align: center;
    }

    .ordenes{
        margin-top:10vh;
        background:#f4f4f4;
        padding:3vh;
        border-radius:2vh;
        border:2px solid black;
    }

    #ver{
        margin-right:1vh;
    }
    
    h3{
    background: -webkit-linear-gradient(45deg,#ff9500, #b300ff,rgb(251, 42, 255));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; 
    font-weight: bold;
    }

    body{
        display: flex;
        justify-content: center;
        }

  /*Inicia Menu*/
    #menu{
        width: 6vh;
        height: 6vh;
    }

    #Jacky{
        background: -webkit-linear-gradient(45deg,#ff9500, #b300ff,rgb(251, 42, 255));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; 
        font-weight: bold;
    }

    .main{
        transition: .5s;
        position: fixed;
        padding: 1vh;
        left: 0;
        top: 8%;
        width: 20%;
        height: 92%;
        background-color: black;
        z-index: 1;
    }

    #Cerrar{
        width: 4vh;
        height: 4vh;
    }
    
    nav{
        background-color: transparent;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 8vh;
        z-index: 1;
        background-color: black;
    }

    #usuario{
        background-color: white;
        width: 6vh;
        height: 6vh;
        border-radius: 3vh;
        border: .5vh solid white;
    }

    #M{
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

        #M:checked ~ #Menu-Desplegado{
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
        margin-left: -3vh;
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
    }
    
    #Contenedor-UC{
        display: flex;
        justify-content: space-between;
        width: 15vh;
    }

    #carrito{
        width: 6vh;
        height: 6vh;
    }

    #ContCart {
        display: flex;
        }

        #num_cart {
        height: 2.5vh;
        text-align: center;
        }

        .ordenes{
            margin-top:10vh;
            background:#f4f4f4;
            padding:3vh;
            border-radius:2vh;
            border:2px solid black;
        }

        #ver{
            margin-right:1vh;
        }
        
        h3{
        background: -webkit-linear-gradient(45deg,#ff9500, #b300ff,rgb(251, 42, 255));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; 
        font-weight: bold;
        }

        .detalle{
            margin-top:10vh;
        }

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
                width: 90%;
                margin-left: 5vh;
            }

            .nombre{
                font-weight: 600;
                font-size:30px;
            }

            .precio{
                font-weight: 500;
                font-size:25px;

            }

            .cantidad{
                display: flex;
                width:70%;
                z-index: 0;
                font-size:20px;
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
                    font-size: 20px;
                }

                .precio{
                    font-size: 15px;
                }

                .cantidad{
                    font-size:14px;
                }

                #contenedorProductos{
                margin-top:25vh;
            
                }

                

            }

            
            @media (width <=768px){
                #M:checked ~ #Menu-Desplegado{
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

           
            label{
                margin-bottom:0;
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
    }

    #Nav-Items{
        padding-left:3vh;
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
    

    <div class="container ordenes">
        <div class="">
            <h3>Pedidos</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Folio</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estatus</th>
                    <th class="text-center" scope="col">Acciones</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $res){ $contador++; ?>
                    <tr>
                    <th scope="row"><?php echo $contador; ?></th>
                    <td><?php echo $res['Folio']; ?></td>
                    <td><?php echo "$".$res['Costo_Total']; ?></td>
                    <td><?php echo $res['Estatus']; ?></td>
                    <td colspan="2">
                        <div class="row">
                            <form action="detalle_pedidos_usuario.php" method="post" id="ver" class="col-lg-2 col-4">
                                <button type="submit" class="btn btn-outline-dark" value="<?php echo $res['Id_Orden_Venta']; ?>" name="id_ov"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <a href="" id="cancelar" class="col-lg-9 col-7 btn btn-danger">Cancelar</a>
                        </div>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>