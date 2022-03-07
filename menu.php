<!doctype html>
<html lang="en">
  <head>

    <link rel="shortcut icon" href="img/Logo3.ico">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="bt/css/bootstrap.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
               <a class="navbar-brand" href="#">
                   <img src="img/po.png"  width="30" height="30" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav">
                      <li class="nav-item active">
                          <a class="nav-link" href="index.php"><b>Inicio</b> <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="formularioventas.php"><b>Ventas</b></a>
                      </li>
                          <li class="nav-item">
                          <a class="nav-link" href="formulariocompras.php" type="u"><b>Compras</b></a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <b>Registrar</b>
                          </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="formularioproductos.php">Registrar Producto</a>
                            <a class="dropdown-item" href="formulariomarca.php">Registrar Marca</a>
                            <a class="dropdown-item" href="formclasificacion.php">Registrar Clasificación</a>
                        </div>
                      </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <b>Consultar</b>
                      </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="consultarventas.php">Consultar Ventas</a>
                        <a class="dropdown-item" href="consultarcompras.php">Consultar Compras</a>
                        <!--<a class="dropdown-item" href="consultacomisionsemanal.php">Consultar Comision Semanal</a> -->
                        <a class="dropdown-item" href="consultaproductos.php">Consultar Productos</a>
                        <a class="dropdown-item" href="consultartikets.php">Consultar Ticket</a>
                        <a class="dropdown-item" href="consultarprodfaltante.php">Mercancia Faltante</a>
                    </div>
                    </li>
                    </ul>
                  </div>
            </nav>
   <script src="bt/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>