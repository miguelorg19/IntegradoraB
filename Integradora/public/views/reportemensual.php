<?php

use src\Config\Conexion;
use src\Modelos\Graficamensual;
require_once '../../src/Modelos/imagenes.php';
use src\Config\Imagenes;
$imagenes = new Imagenes();
require_once '../../src/Modelos/graficamensual.php';
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
if($idUsuario != 1)
{
  header("location:papemaxinicio.php");
}

$modelo = new Graficamensual();

// Verificar si se seleccionó un mes en el formulario
if (isset($_POST['mes'])) {
    $mesSeleccionado = $_POST['mes'];
} else {
    // Si no se seleccionó un mes, usar el mes actual
    $mesSeleccionado = date('n');
}


$datos = $modelo->obtenerGananciasPorMes($mesSeleccionado);

$semanasGanancias = [];

foreach ($datos as $dato) {
  
    $numeroSemana = date('W', strtotime($dato['Fecha']));


    if (isset($semanasGanancias[$numeroSemana])) {
        $semanasGanancias[$numeroSemana] += $dato['Ganancias'];
    } else {
        $semanasGanancias[$numeroSemana] = $dato['Ganancias'];
    }
}


$semanas = [];
$ganancias = [];


foreach ($semanasGanancias as $numeroSemana => $gananciaSemana) {
    $semanas[] = "Semana " . $numeroSemana;
    $ganancias[] = $gananciaSemana;
}

$totalIngresos = 0;
$totalGastos = 0;
$gananciasT = [];

foreach ($datos as $dato) {
    $totalIngresos += $dato['Ganancias'];
    $totalGastos += $dato['Costos'];
    $gananciasT[] = $dato['Ganancias'] - $dato['Costos'];
}

$beneficioTotal = $totalIngresos - $totalGastos;
$totalPerdido = ($beneficioTotal < 0) ? abs($beneficioTotal) : 0;
?>


<!DOCTYPE html>
<html>

<head>
    <title>Informe Mensual de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="/public/css/menucss.css" rel="stylesheet">
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

        .reportetxt {
            margin-top: 10%;
        }

        .totales {
            padding: 5%;
            margin-top: 15%;
        }

        .containers {

            margin-left: 16%;

        }

        .realizarrepbtn {
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

        @media (min-width: 1100px) {
            .grafica-container {
                width: 35rem;
                height: 30rem;
            }
        }

        
        @media (max-width: 1100px) {
            .grafica-container {
                width: 100%;
                height: 20rem;
            }
        }

    </style>
</head>

<body>

    <!-- BARRA DE NAVEGACION -->

    <div class="navcont">
    <nav>
      <!--Menu-->

      <label for="Nav-MenuBtn">
        <img src="../imagenes/menu.png" role="button" alt="" id="menu">
      </label>

      <input type="checkbox" id="Nav-MenuBtn">
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
        <a href="carrito.php"><img src="../imagenes/carrito.png" alt="" id="carrito"></a>
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
            <li>
              <a href="papemaxinicio.php">Inicio</a>
            </li>
            <li>
              <a href="catalogo.php">Catalogo</a>
            </li>
            <li>
              <a href="registroventas.php">Registro de ventas</a>
            </li>
            <li>
              <a href="registrocompras.php">Registro de compras</a>
            </li>
            <li>
              <a href="ventasdiarias.php">Ventas diarias</a>
            </li>
            <li>
              <a href="reportemensual.php">Ventas mensuales</a>
            </li>
            <li>
              <a href="pedidos.php">Pedidos</a>
            </li>
        
            <li><a href="cerrar_sesion.php">Cerrar Sesion</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </div>


    <div class="containers mt-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 row ">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            <h2 class="reportetxt">Reporte mensual</h2>
        </div>

    </div>

    <div class="container mt-3 col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 padre-grafica-totales mt-3" style="background:#f4f4f4; border-radius:8px;  box-shadow: 0px 2px 10px rgba(100,100,100,0.5);">


        <div class="grafica-totales col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <form action="reportemensual.php" class="mb-5" method="post">
                    <select id="mes-selector" class="form-select mb-3 mesesselect" name="mes" style="width:130px" onchange="this.form.submit()">
                        <option value="1" <?php if ($mesSeleccionado == 1) echo 'selected'; ?>>Enero</option>
                        <option value="2" <?php if ($mesSeleccionado == 2) echo 'selected'; ?>>Febrero</option>
                        <option value="3" <?php if ($mesSeleccionado == 3) echo 'selected'; ?>>Marzo</option>
                        <option value="4" <?php if ($mesSeleccionado == 4) echo 'selected'; ?>>Abril</option>
                        <option value="5" <?php if ($mesSeleccionado == 5) echo 'selected'; ?>>Mayo</option>
                        <option value="6" <?php if ($mesSeleccionado == 6) echo 'selected'; ?>>Junio</option>
                        <option value="7" <?php if ($mesSeleccionado == 7) echo 'selected'; ?>>Julio</option>
                        <option value="8" <?php if ($mesSeleccionado == 8) echo 'selected'; ?>>Agosto</option>
                        <option value="9" <?php if ($mesSeleccionado == 9) echo 'selected'; ?>>Septiembre</option>
                        <option value="10" <?php if ($mesSeleccionado == 10) echo 'selected'; ?>>Octubre</option>
                        <option value="11" <?php if ($mesSeleccionado == 11) echo 'selected'; ?>>Noviembre</option>
                        <option value="12" <?php if ($mesSeleccionado == 12) echo 'selected'; ?>>Diciembre</option>
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
                    <p id="ingresos">$<?php echo number_format($totalIngresos, 2); ?></p>
                    <h5 id="gastos-totales">Gastos Totales</h5>
                    <p id="gastos">$<?php echo number_format($totalGastos, 2); ?></p>
                </div>
                <div class="beneficios-perdidas row d-flex">
                    <h5 id="beneficio-total">Beneficio Total</h5>
                    <p id="beneficio">$<?php echo number_format($beneficioTotal, 2); ?></p>
                    <h5 id="total-perdido">Total Perdido</h5>
                    <p id="perdida">$<?php echo number_format($totalPerdido, 2); ?></p>
                </div>
            </div>
        </div>
    </div>



    <script>
        var semanas = <?php echo json_encode($semanas); ?>;
        var ganancias = <?php echo json_encode($ganancias); ?>;

        // Configurar la gráfica
        var ctx = document.getElementById("grafica").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: semanas,
                datasets: [{
                    label: "Ganancias",
                    data: ganancias,
                    backgroundColor: "rgba(54, 162, 235, 0.8)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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