<?php
require_once '../../vendor/autoload.php';
use src\Config\Conexion;
use src\Modelos\Registro;
use src\Modelos\registromet;

if (isset($_GET['correo'])) {
    $correo = $_GET['correo'];
} else {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Registro Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300&family=Noto+Sans+JP:wght@500&family=Rubik:wght@300&family=Ubuntu:ital,wght@1,500&display=swap" rel="stylesheet">
       <style>
        .imglogo
        {
            width: 200px;
            height: 90px;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
        }
        .cont{
            margin: 0 auto;
        }
        .te{
            font-size: .8rem;
            text-color:gray;
            font-family: 'Inter', sans-serif;
        }
        .text{
            font-family: 'Inter', sans-serif;
            font-weight: bold;
        }
        .con{
            background-color: #f4f4f4;
            border-radius: .5rem;
            padding: 1rem;
            box-shadow: 0px 1rem 1rem darkorchid;
        }
        .ini{
            transition: .5s;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .input{
            border-radius: .5rem;
            font-size: .9rem;
            box-shadow: 0px 5px 10px -6px gray;
            font-family: 'Inter', sans-serif;
            width:18rem;
        }
        .ContBtn:hover{
            transition: 1s;
            box-shadow: 0px 0px .1rem .1rem gray;
        }
        .ContBtn{
            width:18rem;
        }
        .barra{
            height: 4rem;
        }
     </style>
      <style>
        body {
            font-family: Arial, sans-serif;
        }

        .verification-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px;
        }

        .verification-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin: 0 5px;
            box-shadow: 0px 0px .1rem .1rem white;
        }

        .verification-input:focus {
            outline: none;
            border-color: #007bff;
        }
    </style>

</head>

<body>
    <nav class="navbar bg-black barra"></nav>
   
    <div class="container justify-content-center">
    <div class="mt-4 d-flex justify-content-center"><img src="../imagenes/jakiepape.png" class="imglogo img-fluid"></div>
    <div class="container d-flex justify-content-center mt-4">
        <div class="col-lg-5 col-sm-12 col-md-8 col-xl-5 con ">
                <br/>
                <div class="text-center row d-flex justify-content-center">
                <h4 class="text">Falta un paso para tu registro!</h4>
               
                <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6 mt-1"><p class="te">Enviamos un codigo a tu correo, ingresa el codigo enviado</p></div>
                </div>
                <div class="d-flex justify-content-center mt-2">
                <form action="../../src/Modelos/verificaciondecorreo.php" method="post">
  <input type=hidden class="correo" id=correo name="correo" value="<?php echo htmlspecialchars($correo); ?>">
    <div class="verification-container" name="codigoo">
        <input type="text" class="verification-input" name="codigo[1]" maxlength="1" autofocus required>
        <input type="text" class="verification-input" name="codigo[2]" maxlength="1" required>
        <input type="text" class="verification-input" name="codigo[3]" maxlength="1" required>
        <input type="text" class="verification-input" name="codigo[4]" maxlength="1" required>
        <input type="text" class="verification-input" name="codigo[5]" maxlength="1" required>
        <input type="text" class="verification-input" name="codigo[6]" maxlength="1" required>

    </div>

        
         
        </div>
        <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-dark ContBtn " name="submit">Enviar</button>
                </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script>
   

   const verificationInputs = document.querySelectorAll('.verification-input');

   verificationInputs.forEach((input, index) => {
       input.addEventListener('input', (event) => {
           const value = event.target.value;
           const maxLength = parseInt(event.target.getAttribute('maxlength'));

           if (value.length >= maxLength) {
               // Move focus to the next input if available
               if (index + 1 < verificationInputs.length) {
                   verificationInputs[index + 1].focus();
               }
           }
       });

       input.addEventListener('keydown', (event) => {
           const BACKSPACE_KEY = 8;

           if (event.keyCode === BACKSPACE_KEY && input.value.length === 0) {
               // Move focus to the previous input if available
               if (index > 0) {
                   verificationInputs[index - 1].focus();
               }
           }
       });
   });
</script>



</body>
</html>