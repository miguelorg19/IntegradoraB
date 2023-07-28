<?php
// require 'src/Modelos/reportemensualbd.php/reportemen.php';

// $ventas = new VentasMensuales("localhost", "root", "", "papemaxp");

// // Conectar a la base de datos
// $ventas->conectar();

// // Verificar si se ha enviado el formulario
// if (isset($_POST['mes'])) {
//     // Obtener el mes seleccionado
//     $mesSeleccionado = $_POST['mes']; // Asegúrate de que el valor del mes se envíe correctamente desde el formulario

//     // Obtener los datos de ventas mensuales para el mes seleccionado
//     $resultados = $ventas->obtenerVentasMensualesPorMes($mesSeleccionado); // Modifica el método para realizar la consulta específica
// } else {
//     // El formulario no se ha enviado, puedes asignar valores predeterminados o mostrar un mensaje de selección
//     $resultados = array('meses' => array(), 'valores' => array());
// }

// // Desconectar de la base de datos
// $ventas->desconectar();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Informe Mensual de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    
    <style>
        .busca1 {
        
            border-radius: .5rem 0rem 0rem .5rem;
            border: none;
            margin: 0 auto;
            width: auto;
        }

        .busca2 {
            border-radius: 0rem .5rem .5rem 0rem;
            margin: 0 auto;
            width: auto;
        }

        .grafica-container {
            width: 35rem;
            height: 30rem;
        }



        .totales {
            padding: 5%;
           margin-top: 15%;
        }

        .containers {
        
           margin-left: 16%;
           
        }

        .realizarrepbtn{
           margin-left: 16%;
        }

        .mesesselect {
            margin-top: 10%;
        }

        .grafica {
            margin-top: 5%;
        }

        .grafica {


            width: 100%;
            height: 100%;

        }

        .grafica .chartjs-size-monitor,
        .grafica .chartjs-size-monitor-expand,
        .grafica .chartjs-size-monitor-shrink {
            width: 100% !important;
            height: 100% !important;
        }

        .grafica .chartjs-render-monitor {
            font-size: 6px;
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGACION -->
     
    <header>
      <nav class="navbar navbar-expand-md" style="background-color:black;">
        <div class="container-fluid">
        <button class="navbar-toggler bg-secondary col-12 bot" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse col-lg-4 col-sm-12 col-md-6 col-xl-4" id="menu">
            <ul class="navbar-nav d-flex justify-content-center">
              <li class="nav-item">
              <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><img src="imagenes/barra-de-menus.png" width="40" height="40"></a>
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
                <button class="btn btn-light bus2 justify-content-center" type="submit"><img src="imagenes/busqueda.png" width="20" height="20"></button>
                </form>
              </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4 d-flex justify-content-end">
                <ul class="navbar-nav">
                <li class="nav-item">
                <a href="usuario.php"><img src="imagenes/usuarioo.png" width="40" height="40"></a>
                <img src="imagenes/carrito-de-compras.png" width="40" height="40">
                </div>
              </li>
            </div>    
      </div>
  </nav>
</header>



    <div class="containers mt-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 row ">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            <h2 class="reportetxt">Reporte mensual</h2>
        </div>
        <div class="d-grid col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 gap-2 d-md-block realizarrepbtn">
            <button class="btn btn-primary text-dark" style="border: 3px solid black;background:#f4f4f4; box-shadow: 0px 2px 10px rgba(100,100,100,0.5);" type="button"><strong>
                    Realizar reporte
                </strong></button>
        </div>
    </div>

    <div class="container mt-3 col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 padre-grafica-totales mt-3" style="background:#f4f4f4; border-radius:8px;  box-shadow: 0px 2px 10px rgba(100,100,100,0.5);">


        <div class="grafica-totales col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <form action="reportemensual.php" class="mb-5" method="post" role="search" id="Buscador1">
                    <select id="mes-selector" class="form-select mb-3 mesesselect" name="mes" style="width:130px">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>

                    </select>
                </form>

                <h2 style="margin-left:15%" id="mes-seleccionado"></h2>
                <div class="grafica-container mt-4">
                    <canvas id="grafica" width="30rem" height="15rem"></canvas>
                </div>
            </div>
            <div class="totales col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ingresos-gastos col">
                    <h5 id="ingresos-totales">Ingresos Totales</h5>
                    <p id="ingresos">$2500</p>
                    <h5 id="gastos-totales">Gastos Totales</h5>
                    <p id="gastos">$0</p>
                </div>
                <div class="beneficios-perdidas row d-flex">
                    <h5 id="beneficio-total">Beneficio Total</h5>
                    <p id="beneficio">$2500</p>
                    <h5 id="total-perdido">Total Perdido</h5>
                    <p id="perdida">$0</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var mesSelector = document.getElementById("mes-selector");


        var mesSeleccionado = document.getElementById("mes-seleccionado");


        mesSelector.addEventListener("change", function() {

            var mes = mesSelector.value;


            var nombreMes = obtenerNombreMes(mes);


            mesSeleccionado.textContent ="Mes seleccionado: "  +nombreMes;
        });


        function obtenerNombreMes(mes) {
            var meses = [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ];

            return meses[mes - 1];
        }
    </script>




    <script>
        // // Obtener los datos de PHP
        // var meses = 
        // var valores = 

        // // Crear la gráfica de barras
        // var ctx = document.getElementById("chart").getContext("2d");
        // var chart = new Chart(ctx, {
        //     type: "bar",
        //     data: {
        //         labels: meses,
        //         datasets: [{
        //             label: "Ventas",
        //             data: valores,
        //             backgroundColor: "rgba(0, 123, 255, 0.5)"
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
        // console.log(meses);
        // console.log(valores);
        // Obtén el elemento canvas
        var canvas = document.getElementById("grafica");

        // Crea la gráfica
        var ctx = canvas.getContext("2d");
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                datasets: [{
                    label: "Costo Total",
                    data: [50, 75, 100, 80, 120, 90, 110],
                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                    borderColor: "rgba(0, 123, 255, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>