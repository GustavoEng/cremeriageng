<?php
include("menu.php");
include("conexion.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Aqua Pet | Consultar</title>

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
        <div>
          <h5><b>Reporte de Comisión Semanal Actual</b></h5>
        </div>
        </br>
        <div class="form-group">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Vendedor</th>
                        <th>Venta Neta</th>
                        <th>Inversión Recuperada</th>
                        <th>Ganancia</th>
                        <th>Comisión</th>
                        <th>Rendimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                         $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Cristian' and week(fechaventa) = week(NOW())";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                            	<td>Cristian</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'];?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }

                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Gustavo' and week(fechaventa) = week(NOW())";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                            	<td>Gustavo</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'];?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }


                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Mostrador' and week(fechaventa) = week(NOW())";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                            	<td>Mostrador</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'];?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }


                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where week(fechaventa) = week(NOW())";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                            	<td>General</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'];?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }
                    ?>

                </tbody>
            </table>
        </div>
     
    </div>
    


    
    
     <script src="bt/js/bootstrap.bundle.min.js"></script>
</body>
</html>