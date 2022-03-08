<?php 
include("menu.php");
include("conexion.php");
$fechaini = 0;
$fechafin = 0;
$vendedor = 0;

if (isset($_POST['submit'])) {
	$fechaini = $_POST['fechaini'].".00:00:00";
    $fechafin = $_POST['fechafin'].".23:59:59";
    $vendedor = $_POST['vendedor'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consultar Ventas</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/Logo2.ico" />
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
                        <label><b>Vendedor</b></label>
                        <select name="vendedor" class="form-control" select style="width:200px">
                            <option value="" selected>Seleccionar Vendedor</option>
                            <option value="Mostrador1" >Mostrador 1</option>
                            <option value="Mostrador2" >mostrador 2</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label><b>Fecha Inicial</b></label>
                        <input type="date" name="fechaini" value="" class="form-control"> 
                    </div>
                    <div class="col-4">
                        <label><b>Fecha Final</b></label>
                        <input type="date" name="fechafin" value="" class="form-control"> 
                    </div>
                
                <div>
                        <label></br></label>
                        <button name="submit" type="submit" class="btn btn-primary btn pull-right form-control">Buscar</button>
              </div>
            </div>
        </form>
        </br>
        </div>
           
        
   
        <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Descripción</th>
                        <th>Precio Venta</th>
                        <th>Cantidad</th>
                        <th>Vendedor</th>
                        <th>Fecha Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($vendedor != null)
                    {
                       $query= "SELECT * FROM cat_ventas as ven INNER JOIN cat_producto as pro ON ven.idproducto=pro.idproducto WHERE ven.vendedor = '$vendedor'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['precioventa'];?></td>
                            <td><?php echo $row['cantidad'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['fechaventa'];?></td>
                        </tr>
                    <?php
                        }
                    }
                    if(empty($fechafin))
                    {
                        $query= "SELECT * FROM cat_ventas as ven INNER JOIN cat_producto as pro ON ven.idproducto=pro.idproducto where to_days(fechaventa) = to_days(NOW())";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['precioventa'];?></td>
                            <td><?php echo $row['cantidad'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['fechaventa'];?></td>
                        </tr>
                    <?php
                        }
                    }

                        if($fechaini != null && $vendedor == null)
                        {

                        $query= "SELECT sum(precioventa) as total FROM cat_ventas where fechaventa between '$fechaini' and '$fechafin'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                            $totalv = $row['total'];
                        }
                    ?>

                <div class="col-4">
                        <label><b>Total Ventas</b></label>
                        <input type="text" name="totalventa" value="<?php echo $totalv;?>" class="form-control"> </br>

                </div>

                <?php

                            $query= "SELECT * FROM cat_ventas as ven INNER JOIN cat_producto as pro ON ven.idproducto=pro.idproducto where ven.fechaventa between '$fechaini' and '$fechafin'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['precioventa'];?></td>
                            <td><?php echo $row['cantidad'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['fechaventa'];?></td>
                        </tr>
                    <?php
                        }}
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="bt/js/bootstrap.bundle.min.js"></script>
</body>
</html>