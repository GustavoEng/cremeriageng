<?php
include("conexion.php");
include("menu.php");
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	$descripcion = $_POST['descripcion'];
	$estado = '0';

	$query = "INSERT INTO cat_clasificacion(nombreclas, clave, descripcion, estado) VALUES('$nombre', '$clave', '$descripcion', '$estado')";

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
    
<body>
    <div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="nombre" placeholder="Tipo" value="" class="form-control">
                    </div>
                    <div class="col-4">
                        <input type="text" name="clave" placeholder="Clave" value="" class="form-control">
                    </div>
                    <div class="col-4">
                        <input type="text" name="descripcion" placeholder="Descripción" value="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                <input type="submit" value="Guardar" name="submit" class="btn btn-primary btn pull-right"/>
            </div>
            
		</form>
		<div class="form-group">
		<table class="table table-hover table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Id</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
				<?php 

					include("conexion.php");

					$query= "SELECT * FROM cat_clasificacion";
					$resultado = $conexion->query($query);
					while($row=$resultado->fetch_assoc()){

				?>

					<tr>
						
						<td><?php echo $row['id'];?></td>
						<td><?php echo $row['nombreclas'];?></td>						

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