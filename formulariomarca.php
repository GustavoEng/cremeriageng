<?php
include("conexion.php");
include("menu.php");
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	$descripcion = $_POST['descripcion'];
	$estado = '0';

	$query = "INSERT INTO cat_marca(nombremarca, clave, descripcionmarca, estado) VALUES('$nombre', '$clave', '$descripcion', '$estado')";

	$resultado = $conexion->query($query);

	if($resultado){
		echo "exito";
	}
	else{
		echo "fallo";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registrar</title>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="bt/css/bootstrap.min.css">
    
</head>
<body>
        
      <div class="container">
		<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="row">
                <hr class="red">
                <div class="col-md-4">
                    <input class="form-control" name="nombre" id="nombre" placeholder="Nombre" type="text" required>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="clave" placeholder="Clave" value="" id="clave" required>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="descripcion" placeholder="Descripción" value="" id="des" required>
                </div>
            </div>
            <br/>
            <div class="form-group float-right">
                <input class="btn btn-primary pull-right" type="submit" value="Guardar" name="submit"/>
            </div>
		</form>
    </div>
    </main>
	<br/><br/>
	<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
          <th>Id</th>
          <th>Nombre</th>
        </tr>
			</thead>
			<tbody>
				<?php 

					include("conexion.php");

					$query= "SELECT * FROM cat_marca";
					$resultado = $conexion->query($query);
					while($row=$resultado->fetch_assoc()){

				?>

					<tr>
						
						<td><?php echo $row['id'];?></td>
						<td><?php echo $row['nombremarca'];?></td>						

					</tr>

					<?php
					}
					?>


			</tbody>
		</table>
 	</div>
  <script src="bt/js/bootstrap.bundle.min.js"></script>

</div>
</body>
</html>