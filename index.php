<?php
include("conexion.php");
include("menu.php"); 

if (isset($_POST['submit'])) {
  $nombreprod = $_POST['nombreprod'];
}

$query = "select * from cat_producto";
$resultado = $conexion->query($query);

$array = array();
if ($resultado){
    while ($row = mysqli_fetch_array($resultado)){
        $productos = $row['descripcion'];
        array_push($array, $productos);
    }
}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Aqua Pet | Inicio</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/Logo2.ico" />
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="bt/css/bootstrap.min.css">


</head>
<body>
        <div class="form-group">
        
        </div>
    <div class="container">
    <div>
          <h5><b>Sistema de Administración</b></h5>
    </div>
    <div><h6>Consultar Productos</h6></div>
    </br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="nombreprod" id="tag" placeholder="Producto" value="" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <button name="submit" type="submit" class="btn btn-primary btn pull-right">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                
            </div>
		</form>

    <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Descripción</th>
                        <th>Precio Venta</th>
                        <th>Existencias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                    if(empty($nombreprod))
                    {
                       
                    }
                        else{
                          $query= "SELECT * FROM cat_producto where descripcion = '$nombreprod'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                      
                    ?>
                        <tr>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['preciopublico'];?></td>
                            <td><?php echo $row['existencias'];?></td>
        
                        </tr>
                    <?php
                        }}
                    ?>

                </tbody>
            </table>
            
        
        </div>
    </div>
        
        
        <script type="text/javascript">
        
            $(document).ready(function (){
                var items = <?= json_encode($array); ?>
                    
                $("#tag").autocomplete({
                    source: items
                });
            });
        
        </script>
    
    </div>


    <script src="bt/js/bootstrap.bundle.min.js"></script>
</body>
</html>