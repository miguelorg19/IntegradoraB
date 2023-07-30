<?php

require_once(__DIR__ . '/../../src/Modelos/graficadiaria.php');

$graficadiaria = new src\Modelos\Graficadiaria();
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('America/Monterrey');
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

$fecha_actual = date('Y-m-d');
$dia_actual_en_espanol = $graficadiaria->obtenerDiaSemanaEnEspanol($fecha_actual);
$datosSemana = $graficadiaria->obtenerGananciasPorSemana();

$labels = array();
$gananciasSemana = array();
$fechaConsulta = date('Y-m-d');
$nombreDias = array(
  'Monday' => 'Lunes',
  'Tuesday' => 'Martes',
  'Wednesday' => 'Miercoles',
  'Thursday' => 'Jueves',
  'Friday' => 'Viernes',
  'Saturday' => 'Sabado',
  'Sunday' => 'Domingo'
);

foreach ($datosSemana as $fecha => $datos) {
  $nombreDia = date('l', strtotime($fecha));
  $nombreDiaEspanol = $nombreDias[$nombreDia];

  $labels[] = $nombreDiaEspanol;
  $gananciasSemana[] = $datos['ganancia'];
}

$resultados = $graficadiaria->obtenerGananciasPorDia($fechaConsulta);

// Obtiene las Ã³rdenes de venta
$ordenesVenta = $graficadiaria->obtenerOrdenesVenta($fechaConsulta);

if ($resultados) {
  $data = $resultados['gananciaPerdidaTotal'];

  // Obtener los totales
  $totalVentaDiario = $graficadiaria->calcularTotalVentaDiario($fechaConsulta);
  $costoTotal = $graficadiaria->calcularCostoTotal($fechaConsulta);
  $gananciaTotal = $graficadiaria->calcularGananciaTotal($fechaConsulta);
} else {

  $labels = [];
  $data = [];


  $totalVentaDiario = 0;
  $costoTotal = 0;
  $gananciaTotal = 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <link href="/public/css/menucss.css" rel="stylesheet">
  <title>Ventas diarias</title>
  <style>
    .ventastxt {
      margin-top: 8%;
    }

    .container {
      margin-top: 4%;
      
    }


    .desc-venta {
      margin-top: 2%;
      height: auto;
      width: 1200px;
      margin-left: 3.8%;
    }

    .total-venta {
      margin-top: 2%;
      margin-left: 9.5%;
      height: auto;
      width: 1200px;

    }

    .desc-venta,
    .total-venta {
      border-radius: 8px;
      background: #f4f4f4;
      background-blend-mode: normal;
      box-shadow: 0px 2px 10px rgba(100, 100, 100, 0.5);
    }
    @media (max-width: 1100px) {
  .desc-venta {
    width:auto;
    margin-left: auto;
    margin-right: auto;
  }

  
  .total-venta {
      
      margin-left:auto;
      height: auto;
      width: auto;

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
      <!--Contenedor Del Usuario Y Carrito De Compras-->
      <div id="Contenedor-UC">
        <a href="usuario.php"><img src="../imagenes/usuario.png" alt="" id="usuario"></a>
       
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

  <h2 class="ventastxt text-center">Ventas diarias</h2>

  <div class="container">
    <?php foreach ($ordenesVenta as $orden) { ?>
      <div class="desc-venta row">
        <div class="descripcion-fecha col-md-6 mb-4 d-flex justify-content-between align-items-center">
          <div class="descripcion ms-5 mt-2">
            <p><strong>Orden de Venta <?php echo $orden['id_orden']; ?></strong></p>
            <p><strong>Fecha </strong><?php echo $orden['fecha']; ?> </p>
          </div>
        </div>

        <div class="info-productos col-md-6 ms-5">
          <?php foreach ($orden['productos'] as $producto) { ?>
            <div class="productos mb-2">
              <p class="mb-0"><?php echo $producto['Cantidad']; ?> <?php echo ' ' ?><?php echo $producto['nombre']; ?> $<?php echo $producto['precio_de_venta']; ?></p>
            </div>
          <?php } ?>

          <div class="total-vendido">
            <p><strong>Total vendido: $<?php echo $orden['total']; ?></strong></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>


  <div class="total-venta">
    <div class="total-fecha d-flex justify-content-between align-items-center">
      <?php
      date_default_timezone_set('America/Mexico_City');
      $fecha_actual = date('d/m/Y');
      ?>
      <p class="ms-5"><strong>Total venta diario: <?php echo $totalVentaDiario; ?></strong></p>
      <p><strong>Fecha </strong><?php echo $fecha_actual; ?> </p>
    </div>

    <canvas id="grafica" width="50%" height="10%"></canvas>




    <div class="info-venta mt-4 text-center">
      <h2>Informe del dia: <?php echo ucfirst($dia_actual_en_espanol); ?></h2>
      <h4>Venta: <?php echo $totalVentaDiario; ?></h4>
      <h4>Costo: <?php echo $costoTotal; ?></h4>
      <h4>Ganancia: <?php echo $gananciaTotal; ?></h4>
    </div>
  </div>






  <script>
    // Obtiene el elemento canvas
    var canvas = document.getElementById("grafica");

    // Crea la grÃ¡fica
    var ctx = canvas.getContext("2d");
    var chart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
          label: "Ganancias",
          data: <?php echo json_encode($gananciasSemana); ?>,
          backgroundColor: "rgba(0, 123, 255, 0.5)",
          borderColor: "rgba(0, 123, 255, 1)",
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          x: {
            display: true,
            title: {
              display: true,
              text: 'Fecha'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Ganancias por dia de semana'
            }
          }
        }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>