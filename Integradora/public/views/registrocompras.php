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
      }
      .te{
            font-size: 1.3em;
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
<header>
      <nav class="navbar navbar-expand-md" style="background-color:black;">
        <div class="container-fluid">
        <button class="navbar-toggler bg-secondary col-12" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
        
        <div class="collapse navbar-collapse col-lg-11 col-sm-6 col-md-6" id="menu">
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
                  <a class="dropdown-item" href="registroventas.php">Registro de ventas</a>
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
        <div class="collapse navbar-collapse col-lg-1 col-sm-6 col-md-6 d-flex justify-content-end con" id="menu">
            <ul class="navbar-nav">
              <li class="nav-item">
              <a href="usuario.php"><img src="../imagenes/usuario.png" width="40" height="40"></a>
              <img src="../imagenes/carrito.png" width="40" height="40">
              </li>
        </div>      
        </div>
  </nav>
</header>
 <div class="container-fluid conts row justify-content-around">
      <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7 cont mt-4">
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
            <input type="text" class="form-control tex" aria-label="Amount (to the nearest dollar)" placeholder="Nombre">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Precio de venta">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Cantidad">
            <div class="mt-2">
              <textarea class="form-control" placeholder="Descripcion del producto" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <h2>Detalles</h2>
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Marca">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Tamaño(opcional)">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Color">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Cantidad por paquete">

            <div class="input-group mt-3">
              <span class="input-group-text tex" id="inputGroup-sizing-default">Categoria</span>
              <select class="form-select form-select-md tex" aria-label=".form-select-md example">
                <option selected>Seleccione</option>
                <option value="1">Escritura</option>
                <option value="2">Papel</option>
                <option value="3">Cuadernos</option>
                <option value="4">Archivo</option>
                <option value="5">Escolares</option>
              </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <br/>
      <h5 class="te">Categoria</h5>
      <div class="input-group mt-3">
      <span class="input-group-text tex" id="inputGroup-sizing-default">Categoria</span>
      <select class="form-select form-select-md tex" aria-label=".form-select-md example">
        <option selected>Seleccione</option>
        <option value="1">Escritura</option>
        <option value="2">Papel</option>
        <option value="3">Cuadernos</option>
        <option value="4">Archivo</option>
        <option value="5">Escolares</option>
      </select>
      </div>
       <br/>
      <h5 class="text">Producto</h5>
      <div class="input-group mb-3 mt-3">
        <input type="text" class="form-control tex" placeholder="Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary tex" type="button" id="button-addon2">Buscar</button>
      </div>
      <div class="mb-3">
        <h5 class="text">Descripcion del producto</h5>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
      </div>
      <h5 class="text">Cantidad</h5>
      <div>
      <input type="number" class="form-control tex" placeholder="Cantidad" aria-label="Recipient's username" aria-describedby="button-addon2">
      </div>
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-outline-dark btn-md">Agregar</button>
      </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 cont table-responsive mt-4">
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#Producto</th>
              <th scope="col">Fecha</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>22/07/2023</td>
              <td>$220.50</td>
            </tr>
          </tbody>
    </table>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-3">
    <button type="submit" class="btn btn-dark btn-md">Aceptar</button>
    </div>
    
    </div>
 </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>