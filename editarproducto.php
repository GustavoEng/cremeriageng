<?php 
	include("conexion.php");
	include("menu.php");

	$idmod = $_POST['idmod'];
	$query = "SELECT * FROM cat_producto WHERE idproducto = '$idmod'";
    $resultado = $conexion->query($query);
    
    while ($row = mysqli_fetch_array($resultado)){

        $codigobarras = $row['codigobarras'];
        $existencias = $row['existencias'];
        $descripcion = $row['descripcion'];
        $pesounitario = $row['pesounitario'];
        $preciocompra = $row['preciocompra'];
        $preciopublico = $row['preciopublico'];
        $preciomayoreo = $row['preciomayoreo'];
        $preciopreferente = $row['preciopreferente'];
        $estado = $row['estado'];
        $idmarca = $row['idmarca'];
        $idclasificacion = $row['idclasificacion'];
    }

    $query = "SELECT * FROM cat_marca where id = '$idmarca'";
    $resultado = $conexion->query($query);
    
    while ($row = mysqli_fetch_array($resultado)){
        $nombremarca = $row['nombremarca'];
    }


    $query = "SELECT * FROM cat_clasificacion where id = '$idclasificacion'";
    $resultado = $conexion->query($query);
    
    while ($row = mysqli_fetch_array($resultado)){
        $nombreclas = $row['nombreclas'];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

<div class="container">
        <div>
          <h5><b>Modúlo De Alta De Nuevos Productos</b></h5>
    </div>
    <div><h6>Registrar un nuevo producto que estará disponible en la tienda</h6></div>
    </br>
		<form action="editar.php" method="POST">
            <div class="form-group">
                <div class="row">
                <input type="hidden" name="idproducto" value="<?php echo $idmod; ?>" class="form-control"> 

                    <div class="col-6">
                        <label for="nombre">Descripción</label>
                        <input placeholder="Descripción" type="text" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control">
                    </div>

                    <div class="col-3">
                        <label for="nombre">Existencias</label>
                        <input placeholder="Existencias" type="text" name="existencias" value="<?php echo $existencias; ?>" class="form-control">
                    </div>

                    <div class="col-3">
                        <label for="nombre">Precio Compra</label>
                        <input placeholder="Precio Compra" type="text" name="preciocompra" value="<?php echo $preciocompra; ?>" class="form-control">
                    </div>                  
                    
                </div>
            </div>
            
        
            
            <div class="form-group">
                <div class="row">

                    <div class="col-3">
                        <label for="nombre">Marca</label>
                        <select name="marca" class="form-control">
                            <?php
                                $consulta = "SELECT * FROM cat_marca";
                                $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                            ?>
                            <option value="<?php echo $idmarca; ?>" selected><?php echo $nombremarca; ?></option>
                            <?php foreach ($ejecutar as $opciones): ?>
                                <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombremarca']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                    
                    <div class="col-3">
                        <label for="nombre">Clasificación</label>
                        <select name="clasificacion" class="form-control">
                            <?php
                                include 'conexion.php';
                                $consulta = "SELECT * FROM cat_clasificacion";
                                $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                            ?>
                            <option value="<?php echo $idclasificacion; ?>" selected><?php echo $nombreclas; ?></option>
                            <?php foreach ($ejecutar as $opciones): ?>
                                <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombreclas']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="nombre">Peso en Gramos</label>
                        <input placeholder="Peso en Gramos" type="text" name="peso" value="<?php echo $pesounitario; ?>" class="form-control">
                    </div>
                                        
                    <div class="col-3">
                        <label for="nombre">Codigo de Barras</label>
                        <input placeholder="Código de Barras" type="text" name="codigobarras" value="<?php echo $codigobarras; ?>" class="form-control">
                    </div>
                    
                </div>
            </div>
                
            <div class="form-group">
                <div class="row">
                    
                    
                   
                    <div class="col-3">
                        <label for="nombre">Precio Publico</label>
                        <input placeholder="Precio Publico" type="text" name="preciopublico" value="<?php echo $preciopublico; ?>" class="form-control">
                    </div>
                    
                    <div class="col-3">
                        <label for="nombre">Precio Mayoreo</label>
                        <input placeholder="Precio Mayoreo" type="text" name="preciomayoreo" value="<?php echo $preciomayoreo; ?>" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="nombre">Precio Preferente</label>
                        <input placeholder="Precio Preferente" type="text" name="preciopreferente" value="<?php echo $preciopreferente; ?>" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">

                    
                    
                    
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class=" col-6">
                     <a href="consultaproductos.php" class="btn btn-primary"/>Regresar</a>
                    </div>
                    <div class="col-5"></div>

                    <div class="col-1">
        			 <input type="submit" value="Guardar" name="actualizar_producto" class="btn btn-primary "/>
                    </div>
                </div>
            </div>
		</form>
    </div>

</body>
</html>