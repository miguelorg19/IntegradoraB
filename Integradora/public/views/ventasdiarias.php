<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="css/menucss.css" rel="stylesheet">
    <title>Ventas diarias</title>
    <style>

        .ventastxt{
            margin-top: 8%;
        }
        .container {
            margin-top: 4%;
        }


        .desc-venta {
            margin-top: 2%;
            height: auto;
            width: 1200px;

        }

        .total-venta {
            margin-top: 2%;
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
    </style>
</head>

<body>
    <!-- BARRA DE NAVEGACION -->
    <div class="navcont">
        <nav>
            <!--Menu-->

            <label for="Nav-MenuBtn">
                <img src="imagenes/barra-de-menus.png" role="button" alt="" id="menu">
            </label>

            <input type="checkbox" id="Nav-MenuBtn">

            <form action="" role="search" id="Buscador1">
                <input type="text" placeholder="Buscar" id="Buscador">
                <img role="button" src="imagenes/busqueda.png" id="Buscar" alt="">
            </form>
            <!--Contenedor Del Usuario Y Carrito De Compras-->
            <div id="Contenedor-UC">
                <a href=""><img src="imagenes/usuarioo.png" alt="" id="usuario"></a>
                <a href=""><img src="imagenes/carrito-de-compras.png" alt="" id="carrito"></a>
            </div>
            <!--Menu Desplegado-->
            <div id="Menu-Desplegado">
                <div id="Contenedor-Menu-Desplegado">
                    <h3>Jacky Papeleria</h3>
                    <label for="Nav-MenuBtn">
                        <img src="imagenes/cerca.png" role="button" alt="" id="Cerrar">
                    </label>
                </div>

                <div id="Nav-Items">
                    <ul>
                        <li><a href="">Inicio</a></li>
                        <li><a href="">Filtro</a></li>
                        <li><a href="">Categorias</a></li>
                        <li>
                            <form action="" role="search" id="Buscador2">
                                <input type="text" placeholder="Buscar" id="Buscador">
                                <img role="button" src="imagenes/busqueda.png" id="Buscar" alt="">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

     
    <h2 class="ventastxt text-center">Ventas diarias</h2>

    <div class="container">
        <div class="desc-venta">
            <div class="descripcion-fecha d-flex justify-content-between align-items-center">
                <div class="descripcion ms-5 mt-2">
                    <p><strong>Descripcion Venta</strong></p>
                </div>
                <div class="fecha me-5 mt-2">
                    <p><strong>Fecha </strong>13/junio/2023 <strong>Hora </strong> 19:34</p>
                </div>
            </div>

            <div class="info-productos col ms-5">
                <div class="productos mb-2">
                    <p class="mb-0">3 marcadores magistral $78</p>
                    <p class="mb-0">1 Lapiz del 2 $3.50</p>
                    <p class="mb-0">10 papel bond $20</p>
                    
                </div>

                <div class="total-vendido">
                    <p><strong>Total vendido: $120</strong></p>
                </div>
            </div>
        </div>

        <div class="desc-venta">
            <div class="descripcion-fecha d-flex justify-content-between align-items-center">
                <div class="descripcion ms-5 mt-2">
                    <p><strong>Descripcion Venta</strong></p>
                </div>
                <div class="fecha me-5 mt-2">
                    <p><strong>Fecha </strong>13/junio/2023 <strong>Hora </strong> 19:34</p>
                </div>
            </div>

            <div class="info-productos col ms-5">
                <div class="productos mb-2">
                    <p class="mb-0">3 marcadores magistral $78</p>
                    <p class="mb-0">1 Lapiz del 2 $3.50</p>
                    <p class="mb-0">10 papel bond $20</p>
                    
                </div>

                <div class="total-vendido">
                    <p><strong>Total vendido: $120</strong></p>
                </div>
            </div>
        </div>
      
        <div class="total-venta">
         <div class="total-fecha d-flex justify-content-between align-items-center">
            <p class="ms-5"><strong>Total venta diario: $240</strong></p>
            <p class="me-5"><strong>Fecha </strong>13/junio/2023</p>
         </div>

         <canvas id="grafica" width="50%" height="10%"></canvas>
         
         <div class="info-venta mt-4 text-center">
         <h4>Venta: $240</h4>
         <h4>Costo: $140</h4>
         <h4>Venta: $100</h4>
         </div>
         

        </div>

    </div>





    <script>
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