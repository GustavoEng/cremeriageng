<?php
include("conexion.php");
include("menu.php");


if (isset($_POST['submit'])) {
    $marca = 			$_POST['marca'];
    $clasificacion = 	$_POST['clasificacion'];
	$descripcion = 		$_POST['descripcion'];
	$existencias = 		$_POST['existencias'];
	$peso = 			"0";
	$codigobarras = 	"0";
	$preciopublico = 	$_POST['preciopublico'];
	$preciomayoreo = 	$_POST['preciomayoreo'];
	$preciopreferente = $_POST['preciopreferente'];
    $preciocompra =     $_POST['preciocompra'];
	$estado = '0';

	$query = "INSERT INTO cat_producto (codigobarras, existencias, descripcion, pesounitario, preciocompra, preciopublico, preciomayoreo, preciopreferente, estado, idmarca, idclasificacion) VALUES ('$codigobarras', '$existencias', '$descripcion', '$peso', '$preciocompra', '$preciopublico', '$preciomayoreo', '$preciopreferente', '$estado', '$marca', '$clasificacion')";

	$resultado = $conexion->query($query);

	if($resultado){?>
        <div class="alert alert-success" role="alert">
            Exito
        </div>
<?php
	}
	else{
		echo "fallo";
	}
}

?>


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
        <div>
          <h5><b>Modúlo De Alta De Nuevos Productos</b></h5>
    </div>
    <div><h6>Registrar un nuevo producto que estará disponible en la tienda</h6></div>
    </br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <div class="form-group">
                <div class="row">
                    
                    <div class="col-6">
                        <input placeholder="Descripción" type="text" name="descripcion" value="" class="form-control">
                    </div>

                    <div class="col-3">
                        <input placeholder="Existencias" type="text" name="existencias" value="" class="form-control">
                    </div>                    

                    <div class="col-3">
                        <input placeholder="Precio Compra" type="text" name="preciocompra" value="" class="form-control">
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <div class="row">                  
                    <div class="col-3">
                        <select name="marca" class="form-control">
                            <?php
                                include 'conexion.php';
                                $consulta = "SELECT * FROM cat_marca";
                                $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                            ?>
                            <option value="" selected>Seleccionar Marca</option>
                            <?php foreach ($ejecutar as $opciones): ?>
                                <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombremarca']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                    
                    <div class="col-3">
                        <select name="clasificacion" class="form-control">
                            <?php
                                include 'conexion.php';
                                $consulta = "SELECT * FROM cat_clasificacion";
                                $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                            ?>
                            <option value="" selected>Seleccionar Clasificación</option>
                            <?php foreach ($ejecutar as $opciones): ?>
                                <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombreclas']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <input placeholder="Peso en Gramos" type="text" name="peso" value="" class="form-control">
                    </div>
                    <div class="col-3">
                        <input placeholder="Código de Barras" type="text" name="codigobarras" value="" class="form-control">
                    </div>
                </div>
            </div>            
            
            <div class="form-group">
                <div class="row">
                    
                    
                    
                </div>
            </div>
                
            <div class="form-group">
                <div class="row">
                    
                    <div class="col-3">
                        <input placeholder="Precio Publico" type="text" name="preciopublico" value="" class="form-control">
                    </div>
                    
                    <div class="col-3">
                        <input placeholder="Precio Mayoreo" type="text" name="preciomayoreo" value="" class="form-control">
                    </div>
                    <div class="col-3">
                        <input placeholder="Precio Preferente" type="text" name="preciopreferente" value="" class="form-control">
                    </div>
                </div>
            </div>
            
            
            <div class="form-group float-right">
			 <input type="submit" value="Guardar" name="submit" class="btn btn-primary btn pull-right"/>
            </div>

		</form>
    </div>
    
    
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        function mostrar(id) {
            if (id == "1") {
                $("#peso").show();
                $("#lumenes").hide();
                $("#caducidad").hide();
                $("#longitud").hide();
            }

        }
    </script>
    <script src="bt/js/bootstrap.bundle.min.js"></script>
    </body>
</html>