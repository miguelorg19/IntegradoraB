<?php

require '../../src/Config/database.php';

session_start();

if(!isset($_SESSION['NOMBRE_USUARIO'])){

  header("location:login.php");

}

$num_cart=0;
if(isset($_SESSION['carrito']['productos'])){
$num_cart = count($_SESSION['carrito']['productos']);
}

$db = new Conexion();
$con = $db->conectar();

$id;

if(isset($_GET['id'])){
$id = $_GET['id'];
}
else{
  header("location:catalogo.php");
}

$sql = $con->prepare("SELECT * FROM Productos WHERE ID_Productos = :id");
$sql->execute(array("id"=>$id));
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);



$con = null;
$sql = null;


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Rubik:wght@300&family=Ubuntu:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Producto</title>

    <style>
        .bus1{
            border-radius:.5rem 0rem 0rem .5rem;
            border: none;
            margin: 0 auto;
        }
        .bus2{
            border-radius: 0rem .5rem .5rem 0rem;
            margin: 0 auto;
        }
        .bas{
          margin-left: 0.6rem;
        }
        .con{
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: .5rem;
            padding: 1.5rem;
            box-shadow: 0px 0px .1rem .1rem gray;
        }
        .cons{
            border-radius: .5rem;
        }
        .img{
            width: 88%;
            height: 88%;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
        }
        .img2{
            width: 100%;
            height:100%;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
        }
        .bot{
          margin-bottom: 2%;
        }
        .cons{
          margin: 0 auto;
        }
        .card{
          border: 0px;
        }
        .card:hover{
          box-shadow:  0 0 .5rem gray;
          cursor: pointer;
          transition: .2s;
        }
        .te{
            font-size: 1.5rem;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .text{
            font-family: 'Noto Sans JP', sans-serif;
            font-size: .8rem;
            font-weight: bold;
        }
        .tex{
          font-size: .8rem;
            font-family: font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .texp{
          font-size: 1.6rem;
            font-family: font-family: 'Inter', sans-serif;

        }
        .texx{
          font-size: .8rem;
            text-color:gray;
            font-family: font-family: 'Inter', sans-serif;
        }
        .prec{
          font-size: 1.6rem;
          text-color:black;
          font-family: font-family: 'Inter', sans-serif;
        }
        .texxx{
          font-size: 2rem;
            text-color:gray;
            font-family: font-family: 'Inter', sans-serif;
        }
        .imgcards{
          margin: 0 auto; 
          margin-top:6%;
        }
        .texd{
            font-size: .9rem;
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>
<body>
<header>
      <nav class="navbar navbar-expand-md" style="background-color:black;">
        <div class="container-fluid">
        <button class="navbar-toggler bg-secondary col-12 bot" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse col-lg-4 col-sm-12 col-md-6 col-xl-4" id="menu">
            <ul class="navbar-nav d-flex justify-content-center">
              <li class="nav-item">
              <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><img src="../imagenes/menu.png" width="40" height="40"></a>
              <ul class="dropdown-menu bg-light">
                <li>
                  <a class="dropdown-item" href="">Inicio</a>
                </li>
                <li>
                  <a class="dropdown-item" href="">Catalogo</a>
                </li>
                <li>
                  <a class="dropdown-item" href="registrocompras.php">Registro de Compras</a>
                </li>
                <li>
                  <a class="dropdown-item" href="registroventas.php">Registro de Ventas</a>
                </li>
                <li>
                  <a class="dropdown-item" href="">Ventas diarias</a>
                </li>
                  <li>
                  <a class="dropdown-item" href="">Ventas mensuales</a>
                </li>
                <li>
                  <a class="dropdown-item" href="pedidos.php">Pedidos</a>
                </li>
              </ul>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-between input-group row">
              <div class="col-xl-5 col-lg-5 col-md-4 col-sm-8 col-7 d-flex justify-content-center bas">
                <form class="d-flex" role="search">
                <input class="form-control bus1" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-light bus2 justify-content-center" type="submit"><img src="../imagenes/busqueda.png" width="20" height="20"></button>
                </form>
              </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4 d-flex justify-content-end">
                <ul class="navbar-nav">
                <li class="nav-item">
                <a href="usuario.php"><img src="../imagenes/usuario.png" width="40" height="40"></a>
                <a href="carritodecompras.php"><img src="../imagenes/carrito.png" width="40" height="40"></a>
                <span id="num_cart" class="badge bg-primary"><?php echo $num_cart; ?></span>
                
                </div>
              </li>
            </div>    
      </div>
  </nav>
</header>

                <?php foreach($resultado as $res){  
                  ?>
                <div class="container mt-4 row col-9 d-flex justify-content-center con" >
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center cons">
                        <img src="../imagenes/Borra.png" class="img2 img-fluid img-thumbnail">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <h1 class="te"><?php echo $res['Nombre']; ?></h1>
                        <p class="texp">Precio del producto</p>
                        <p class="prec"><?php echo "$ ".$res['Precio_de_Venta']; ?></p>
                        <div class="mt-4 row ">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-4 mt-1">
                        <input type="number" id="cantidad" class="form-control tex" min="1" value="1" aria-label="Recipient's username" aria-describedby="button-addon2">
                        </div>
                          <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-8 d-flex justify-content-end mt-1">
                          <button class="btn btn-outline-success Products" onclick="addProduct(<?php echo $res['ID_Productos']; ?>)">Añadir</button>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-3">
                        <h1 class="te">Caracteristicas</h1>
                        <table class="table texd">
                        <tbody>
                        <tr>
                        <th scope="row">Marca</th>
                        <td>Scribe</td>
                        </tr>
                        <tr>
                        <th scope="row">Tamaño</th>
                        <td>100 hojas</td>
                        </tr>
                        <tr>
                        <th scope="row">Color</th>
                        <td>Rojo</td>
                        </tr>
                      </tbody>
                      </table>
                  </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-3">
        <h1 class="te">Detalles</h1>
        <p class="texd"><?php echo $res['Descripcion']; ?></p>
        </div>
        </div>
                </div>
                  <?php } ?>
              <div class="container d-flex justify-content-center mt-3 col-9">
                <h1 class="texxx text-center">Productos recomendados</h1></div>
                <div class="container  d-flex justify-content-between cons mt-2 col-9 row">
                <div class="card col-xl-2 col-lg-2 col-md-5 col-sm-5 col-5">
                  <div class="imgcards d-flex justify-content-center">
                    <img src="public/imagenes/libreta.jpg" class="card-img-top img" alt="...">
                 </div>
                  <div class="card-body">
                    <h5 class="text">Cuaderno de raya scribe 150 hojas</h5>
                    <h5 class="texx">$27.50</h5>
                    <div class="d-flex justify-content-center row">
                    <button type="submit" class="btn btn-dark btn-md tex col-12">Comprar</button>
                    </div>
                  </div>
                </div>
                <div class="card col-xl-2 col-lg-2 col-md-5 col-sm-5 col-5">
                  <div class="imgcards d-flex justify-content-center">
                    <img src="public/imagenes/libreta.jpg" class="card-img-top img" alt="...">
                 </div>
                  <div class="card-body">
                    <h5 class="text">Cuaderno de raya scribe 150 hojas</h5>
                    <h5 class="texx">$27.50</h5>
                    <div class="d-flex justify-content-center row">
                    <button type="submit" class="btn btn-dark btn-md tex col-12">Comprar</button>
                    </div>
                  </div>
                </div>
                <div class="card col-xl-2 col-lg-2 col-md-5 col-sm-5 col-5">
                  <div class="imgcards d-flex justify-content-center">
                    <img src="public/imagenes/libreta.jpg" class="card-img-top img" alt="...">
                 </div>
                  <div class="card-body">
                    <h5 class="text">Cuaderno de raya scribe 150 hojas</h5>
                    <h5 class="texx">$27.50</h5>
                    <div class="d-flex justify-content-center row">
                    <button type="submit" class="btn btn-dark btn-md tex col-12">Comprar</button>
                    </div>
                  </div>
                </div>
                <div class="card col-xl-2 col-lg-2 col-md-5 col-sm-5 col-5">
                  <div class="imgcards d-flex justify-content-center">
                    <img src="public/imagenes/libreta.jpg" class="card-img-top img" alt="...">
                 </div>
                  <div class="card-body">
                    <h5 class="text">Cuaderno de raya scribe 150 hojas</h5>
                    <h5 class="texx">$27.50</h5>
                    <div class="d-flex justify-content-center row">
                    <button type="submit" class="btn btn-dark btn-md tex col-12">Comprar</button>
                    </div>
                  </div>
                </div>
              </div>

                <script type="text/javascript">                    
                      function addProduct(id){
                      const elemento = document.getElementById('num_cart');
                      const cantidad = parseInt(document.getElementById('cantidad').value);

                      if(cantidad >= 1){
                        let url = 'agregarcarrito.php';
                            let formData = new FormData()
                            formData.append('id',id)
                            formData.append('cantidad',cantidad)

                            fetch(url, {
                              method: 'POST',
                              body: formData,
                              mode: 'cors'
                            }).then(response => response.json())
                            .then(data => {
                              if(data.ok){
                                elemento.innerHTML = data.numero;
                                if(data.existe){
                                  swal("Lo Tienes","Este Producto Se Encuentra En Tu Carrito","info");
                                }
                                else{
                                  swal("Agregado","Se Agregó Correctamente Al Carrito","success");
                                }
                              }
                            })
                        }else{
                          swal("Error","No Puedes Agregar Cantidades Negativas","warning");      
                          }
                        }
                  </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>