<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <link rel="stylesheet" href="public/css/styles.css">

    <style>
        /* Estilos iniciales de los contenedores */
        #ContBtn1,
        #ContBtn2 {
            width: 50%; /* Ajusta el ancho según tus necesidades */
            text-align: center;
            margin-top: 2px; /* Ajusta el margen superior según tus necesidades */
        }

        #ContBtn1 a,
        #ContBtn2 a {
            padding: 10px 20px;
            background-color: black;
            border: 1px;
            text-decoration: none;
            color: #fff;
            border-radius: 14px;
            transition: background-color 0.3s ease;
            display: block; 
            margin: 0 auto;
        }

        #ContBtn1 a:hover,
        #ContBtn2 a:hover {
            background-color: #fff;
        }
        #ingresar, #registrarse {
            text-align: center;
            padding: 20px 20px;
            justify-content: center;
            margin: auto;
        }
    </style>
</head>
<body>
    <nav>
    <img src="public/imagenes/home-automation.png" alt="" id="home">
        <h1>Bienvenido</h1>
    </nav>

    <div id="container">
        <div id="contenedor">
            <img src="public/imagenes/zyro-image.png" alt="" id="logo">
            <div id="ContenedorBtns">
                <div id="ContBtn1">
                    <button type="submit" href="public/views/login.php" id="ingresar">Ingresar</button>
                </div>
                <div id="ContBtn2">
                    <button type="submit" href="public/views/registro.php" id="registrarse">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para centrar las etiquetas <a>
        function centrarEtiquetas() {
            const contenedorBtns = document.getElementById('ContenedorBtns');
            const etiquetasA = contenedorBtns.getElementsByTagName('a');

            for (let i = 0; i < etiquetasA.length; i++) {
                etiquetasA[i].style.display = 'inline-block';
            }
        }

        // Llamar a la función después de que la página se haya cargado completamente
        window.onload = centrarEtiquetas;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>