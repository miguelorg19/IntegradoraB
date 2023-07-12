<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tablas de Multiplicar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Practicas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Tablas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="numeross.php">Numeros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mayor.php">Mayor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mes.php"> Mes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="calificaciones.php">Calificaciones</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </nav>
    <br>

    
    <div class="input-group mb-3">
      <input type="number" class="form-control" placeholder="Ingrese un Numero" aria-label="Recipient's username" aria-describedby="button-addon2" id="rangeStart">
      <input type="number" class="form-control" placeholder="Ingrese un Numero" aria-label="Recipient's username" aria-describedby="button-addon2" id="rangeEnd">
      <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="generateMultiplicationTable()">Mostrar</button>
    </div>
    
    

    <?php
    echo'<table id="multiplicationTable"></table>'
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script>
        function generateMultiplicationTable() {
        var rangeStart = parseInt(document.getElementById("rangeStart").value);
        var rangeEnd = parseInt(document.getElementById("rangeEnd").value);
        if (rangeStart==""){
            alert("El campo 1 esta vacio");
            document.getElementById("rangeStart").focus();
        }
        else{
            if (rangeEnd=="")
            {
            alert("El campo 2 esta vacio");
        document.getElementById("rangeEnd").focus();
            }
        }
      var table = document.getElementById("multiplicationTable");
      table.innerHTML = ""; // Limpiar tabla anterior (si existe)
  
      for (var i = rangeStart; i <= rangeEnd; i++) {
      var row = document.createElement("tr");
      var headerCell = document.createElement("th");
      headerCell.textContent = "Tabla del " + i;
      row.appendChild(headerCell);
  
      for (var j = 1; j <= 10; j++) {
        var cell = document.createElement("td");
        cell.textContent = "|"+i + " x " + j + " = " + (i * j)+" |";
        row.appendChild(cell);
      }
  
      table.appendChild(row);
    }
  }
    </script>
  </body>
</html>