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
	<title>Aqua Pet | Consultar</title>
    
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
                        <th>Proveedor</th>
                        <th>Cantidad Productos</th>
                        <th>Importe Ticket</th>
                        <th>Fecha Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                    if(empty($fechafin))
                    {
                        $query= "SELECT * FROM ticketscom where month(fechaticketcom) = month(NOW())";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['proveedor'];?></td>
                            <td><?php echo $row['cantidadproductos'];?></td>
                            <td><?php echo $row['totalcompra'];?></td>
                            <td><?php echo $row['fechaticketcom'];?></td>
                        </tr>
                    <?php
                        }
                    }
                        else{
                            $query= "SELECT * FROM ticketscom where fechaticketcom between '$fechaini' and '$fechafin'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['proveedor'];?></td>
                            <td><?php echo $row['cantidadproductos'];?></td>
                            <td><?php echo $row['totalcompra'];?></td>
                            <td><?php echo $row['fechaticketcom'];?></td>
                        </tr>
                    <?php
                        }

                         $query= "SELECT sum(totalcompra) as total FROM ticketscom where fechaticketcom between '$fechaini' and '$fechafin'";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td></td>
                                
                                <td><b>Total</b></td>
                                <td id="total"><?php echo $row['total'];?></td>
                                <td></td>
                            </tr>
                    <?php
                        }


                    }
                    ?>

                </tbody>
            </table>
            </div>
    </div>
    


<!-- Modal -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <form action="editar.php" method="POST">
          <input type="hidden" name="id" id="update_id">
          <div class="form-group">
              <label for="">Modelo</label>
              <input type="text" name="modelo" id="modelo" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Descripción</label>
              <input type="text" name="descripcion" id="descripcion" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Existencias</label>
              <input type="text" name="existencias" id="existencias" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Precio Publico</label>
              <input type="text" name="precio" id="precio" class="form-control">
          </div>
              <div class="form-group">
              <label for="">Precio Mayoreo</label>
              <input type="text" name="preciomay" id="preciomay" class="form-control">
          </div>
        <div class="form-group">
                <label for="">Precio Compra</label>
                <input type="text" name="preciocompra" id="preciocompra" class="form-control">
          </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    
    
     <script src="bt/js/bootstrap.bundle.min.js"></script>
      
</body>
</html>