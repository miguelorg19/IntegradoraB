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

    <title>Agregar Producto</title>
    <style>
        .cos{
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: .5rem;
            box-shadow: 0px .5rem .5rem gray;
        }
        .coss{
            padding: 2rem;
        }
        .arch{
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            width: 100%;
            
        }
        .ti{
            font-family: 'Inter', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;         
        }
        .img{
            width: 11rem;
            height: 11rem;
        }
        .contg{
            background-color: white;
            border-radius: .5rem;
        }
        .in{
            width: 100%;
            border-radius: .5rem;
            box-shadow: 0px .2rem .2rem gray;
        }
        .cop{
            margin: 0 auto;
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
                  <a class="dropdown-item" href="registrocompras.php">Registro de Compras</a>
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
                <li>
                  <a class="dropdown-item" href="registroventas.php">Registro de ventas</a>
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
        <div class="container col-xl-8 col-lg-8 col-sm-6 col-md-6 col-sm-12 col-12 mt-4 row cos table-responsive">
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
            <th scope="row">1</th>
            <td>Lapiz</td>
            <td>Lapiz</td>
            <td>15</td>
            <td>$12.50</td>
            <td>Papel</td>
            <td><button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil-square"></i></button></td>
            <td><button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></td>
          </tr>
        </tbody>
      </table>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="ti">Editar</h1>
            </div>
            <div class="modal-body">
            <input type="text" class="form-control tex" aria-label="Amount (to the nearest dollar)" placeholder="Nombre">
            <input type="number" class="form-control tex mt-2" aria-label="Amount (to the nearest dollar)" placeholder="Precio de venta">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>
</html>