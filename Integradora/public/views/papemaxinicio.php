<?php
require '../../src/Modelos/enviocorreoinicio.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="/public/css/menucss.css" rel="stylesheet">
    <title>Inicio</title>
    <style>
        .carousel-item img {
            height: 13rem;
        }


        .carousel-control-prev.disabled,
        .carousel-control-next.disabled {
            pointer-events: none;
        }

        .logojakie {
            filter: brightness(1.1);
            mix-blend-mode: multiply;



        }


        .card {
            background-color: #f4f4f4;
            box-shadow: 0px 5px 5px mediumslateblue;
        }

        .containerproductos {

            width: 80%;
        }

        .textobienvennido {
            font-family: 'Brush Script MT';
        }

        .containerproductos,
        .carouselcontainer,
        .contactanoscontainer {
            margin-top: 10%;
        }


        .logocontainer {
            margin-top: 8%;
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

            <form action="" role="search" id="Buscador1">
                <input type="text" placeholder="Buscar" id="Buscador">
                <img role="button" src="../imagenes/busqueda.png" id="Buscar" alt="">
            </form>
            <!--Contenedor Del Usuario Y Carrito De Compras-->
            <div id="Contenedor-UC">
                <a href="usuario.php"><img src="../imagenes/usuario.png" alt="" id="usuario"></a>
                <a href="carrito.php"><img src="../imagenes/carrito.png" alt="" id="carrito"></a>
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
                                <img role="button" src="../imagenes/busqueda.png" id="Buscar" alt="">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <div class="logocontainer text-center">

        <img src="../imagenes/jakiepape.png" class="img-fluid logojakie" width="280" height="150" alt="Logo de la papelería">

    </div>

    <!-- INFORMACION PAPE -->

    <h5 class="mt-5 text-center textoencuentra">Encuentra una gran variedad de productos...</h5>

    <!-- CAROUSEL -->
    <div class="container text-center carouselcontainer">

        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col text-center">
                            <a href="producto.php">
                                <img src="../imagenes/corrector.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-center">Corrector</h5>
                                    <p class="text-center">Descripción</p>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center">
                            <a href="producto.php">
                                <img src="../imagenes/corrector.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-center">Corrector</h5>
                                    <p class="text-center">Descripción</p>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center">
                            <a href="producto.php">
                                <img src="../imagenes/corrector.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-center">Corrector</h5>
                                    <p class="text-center">Descripción</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item img-fluid">
                    <div class="row">
                        <div class="col">
                            <a href="producto.php">
                                <img src="../imagenes/cuadernoscribeplus.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Cuaderno</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>
                        <div class="col">
                            <a href="producto.php">
                                <img src="../imagenes/cuadernoscribeplus.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Cuaderno</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>
                        <div class="col">
                            <a href="producto.php">
                                <img src="../imagenes/cuadernoscribeplus.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Cuaderno</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item img-fluid">
                    <div class="row">
                        <div class="col">
                            <a href="producto.php">
                                <img src="/..imagenes/boloigrafo.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Bolígrafo</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>

                        <div class="col">
                            <a href="producto.php">
                                <img src="../imagenes/boloigrafo.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Bolígrafo</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>

                        <div class="col">
                            <a href="producto.php">
                                <img src="imagenes/boloigrafo.jpeg" class="d-block w-50 mx-auto img-fluid" alt="...">
                            </a>
                            <div class="row">
                                <h5 class="text-center">Bolígrafo</h5>
                                <p class="text-center">Descripción</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- PRODUCTOS -->
    <div class="containerproductos mx-auto ">
        <div class="row">

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/cuadernoscribeplus.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/boloigrafo.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/corrector.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/cuadernoscribeplus.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>



        </div>

        <div class="row mt-5">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/cuadernoscribeplus.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/boloigrafo.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/corrector.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 producto">
                <div class="card">
                    <img src="../imagenes/cuadernoscribeplus.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Nombre Del Producto.</h5>
                        <p class="card-text">Precio.</p>
                        <a href="#" class="btn btn-dark">Añadir</a>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- CONTACTANOS -->
    <div class=" container-fluid bg-dark text-white py-3 contactanoscontainer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 text-center">
                    <h3 class="mt-4">Contactanos</h3>


                    <form class="mt-5" action="papemaxinicio.php" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="Asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="Asunto" name="Asunto" placeholder="Ingrese su asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Ingrese su mensaje" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>

                        <div id="mensaje-envio" class="mt-3 <?php echo $estiloMensaje; ?>"><?php echo $mensajeEnvio; ?></div>
                    </form>


                </div>

                <div class="mt-5 col-md-6 text-center">
                    <div class="d-flex flex-column mt-5">
                        <div class="ubicacion mt-5">
                            <img src="imagenes/ubicacion.png" alt="Icono de ubicación" width="20" height="20">
                            Avenida del pedregal #567 col. San pedro
                        </div>
                        <div class="telefono mt-5">
                            <img src="imagenes/telefonologo.png" alt="Icono de teléfono" width="20" height="20">
                            +52 8713114045
                        </div>
                        <div class="correojakie mt-5">
                            <img src="imagenes/correo.avif" alt="Icono de correo electrónico" width="20" height="20">
                            jakiepape@papeleria.com
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- CAROUSEL AUTOMATICO -->
    <script>
        const carousel = document.getElementById('carouselExample');
        const intervalTime = 4000;
        let slideIndex = 0;

        function cambiarSlide() {
            carousel.querySelectorAll('.carousel-item').forEach((item) => {
                item.classList.remove('active');
            });

            slideIndex = (slideIndex + 1) % carousel.querySelectorAll('.carousel-item').length;
            carousel.querySelectorAll('.carousel-item')[slideIndex].classList.add('active');
        }

        setInterval(cambiarSlide, intervalTime);
    </script>

    <!-- ESCONDER BOTONES CARRUSEL -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menuBtn = document.getElementById('Nav-MenuBtn');
            var carouselControls = document.querySelectorAll('.carousel-control-prev, .carousel-control-next');

            menuBtn.addEventListener('click', function() {
                if (menuBtn.checked) {
                    carouselControls.forEach(function(control) {
                        control.classList.add('disabled');
                        control.classList.add('invisible');
                    });
                } else {
                    carouselControls.forEach(function(control) {
                        control.classList.remove('disabled');
                        control.classList.remove('invisible');
                    });
                }
            });
        });
    </script>

   <!-- REDIRECCION AL INICIO -->
    <script>
        window.onload = function() {
            window.scrollTo(0, 0);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>