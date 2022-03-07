<?php
include("menu.php");
include("conexion.php"); 
if (isset($_POST['submit'])) {
	$fechaini = $_POST['fechaini'].".00:00:00";
    $fechafin = $_POST['fechafin'].".23:59:59";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Aqua Pet | Productos Faltantes</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="bt/css/bootstrap.min.css">
    
    
</head>
<body>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="exampleFormControlSelect1"><b>Fecha Inicial</b></label>
                        <input type="date" name="fechaini" value="<?php echo date("Y-m-dT00:00");?>" class="form-control"> 
                </div>
                <div class="col-4">
                        <label for="exampleFormControlSelect1"><b>Fecha Final</b></label>
                        <input type="date" name="fechafin" value="<?php echo date("Y-m-dT23:59");?>" class="form-control"> 
                </div>
                <div>
                        <label></br></label>
                        <button name="submit" type="submit" class="btn btn-primary btn pull-right form-control">Buscar</button>
                </div>
            </div>
          </div>
        </form>
        <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Existencias</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Precio Preferente</th>
                        <th>Precio Mayoreo</th>
                        <th>idclas</th>
                        <th>clas</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");

                    if(empty($fechafin))
                    {
                        $query= "SELECT * FROM cat_producto where existencias < 2 and estado = 0";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                        	$idclas = $row['idclasificacion'];
                    ?>
                        <tr>
                        	<td hidden="true"><?php echo $row['idproducto'];?></td>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['existencias'];?></td>
                            <td><?php echo $row['preciocompra'];?></td>
                            <td><?php echo $row['preciopublico'];?></td>
                            <td><?php echo $row['preciopreferente'];?></td>
                            <td><?php echo $row['preciomayoreo'];?></td>
                            <td hidden="true"><?php echo $row['estado'];?></td>
                            <td><?php echo $row['idclasificacion'];?></td>
                            <?php
                                $consultam = "SELECT * FROM cat_clasificacion WHERE id = '$idclas'";
                                $resultadom = mysqli_query($conexion,$consultam) or die(mysql_error($conexion));
                                while ($row = mysqli_fetch_array($resultadom)){
						        $nombreclas = $row['nombreclas'];
						    }
                            ?>
                            <td><?php echo $nombreclas;?></td>
                            <td><button type="button" class="btn btn-success editbtn" data-bs-toggle="modal" data-bs-target="#modificar">Modificar</button></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
            </div>
    </div>

           <!-- Modal modificar Fila -->
        <div class="modal fade" id="modificar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                  <form action="editar.php" method="POST">
                  <input type="hidden" name="id" id="edit_row">
                    <div class="form-group">
                      <label for="">Descripción</label>
                      <input type="text" name="descripcion" id="descripcion" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="">Existencias</label>
                      <input type="text" name="existencias" id="existencias" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="">Precio publico</label>
                      <input type="text" name="precio" id="precio" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="">Precio preferente</label>
                        <input type="text" name="preciopreferente" id="preciopreferente" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="">Precio Mayoreo</label>
                        <input type="text" name="preciomayoreo" id="preciomayoreo" class="form-control">
                  </div>

                  <div class="form-group">
                  	<input type="" name="nombclas" id="nombclas">
                	<select name="clasificacion" class="form-control">
                        <?php
                            $consulta = "SELECT * FROM cat_clasificacion";
                            $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                        ?>
                        <option value="" selected>Seleccionar Clasificación</option>
                        <?php foreach ($ejecutar as $opciones): ?>
                            <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombreclas']?></option>
                        <?php endforeach ?>
                    </select>	
                  </div>

                  <div class="form-group">
                        <label for="">Estado</label>
                        <input type="text" name="estado" id="estado" class="form-control">
                  </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editar_prod_aux" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <script>
        $('.editbtn').on('click',function(){
        
        $tr=$(this).closest('tr');
        var datos = $tr.children("td").map(function(){
           return $(this).text();
        });
        
        $('#edit_row').val(datos[0]);
        $('#descripcion').val(datos[1]);
        $('#existencias').val(datos[2]);
        $('#precio').val(datos[4]);
        $('#preciopreferente').val(datos[5]);
        $('#preciomayoreo').val(datos[6]);
        $('#estado').val(datos[7]);
        $('#idclas').val(datos[8]);
        $('#nombclas').val(datos[9]);
        
    });
    </script>
    
     <script src="bt/js/bootstrap.bundle.min.js"></script>
      
</body>
</html>