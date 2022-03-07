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
                    if(empty($fechafin))
                    {
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

                    }
                        else{
                            $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Veronica' and fechaventa between '$fechaini' and '$fechafin'";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                                $comisionv = null;
                                if($row['ventas']==0)
                                {

                                }
                                if($row['ventas'] > 1 && $row['ventas'] < 1000)
                                {
                                    $comisionv = $row['comimp']-200;
                                    $comisionv = $comisionv/2;
                                }
                                if($row['ventas'] > 999)
                                {
                                    $comisionv = $row['comimp']-200;
                                    $comisionv = $comisionv/4;
                                }
                            }

                            $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Cristian' and fechaventa between '$fechaini' and '$fechafin'";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td>Cristian</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'] + $comisionv;?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }
                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Gustavo' and fechaventa between '$fechaini' and '$fechafin'";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td>Gustavo</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <td><?php echo $row['comimp'] + $comisionv;?></td>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }
                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Veronica' and fechaventa between '$fechaini' and '$fechafin'";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                                $comision = $row['comimp']-200;
                                $comision = $comision / 2;
                    ?>
                            <tr>
                                <td>Veronica</td>
                                <td><?php echo $row['ventas'];?></td>
                                <td><?php echo $row['invrec'];?></td>
                                <td><?php echo $row['com'];?></td>
                                <?php 
                                    if ($row['ventas'] > 999)
                                        {
                                ?>
                                    <td><?php echo $comision;?></td>
                                <?php
                                 }
                                 else
                                 { 
                                ?>
                                <td></td>
                                <?php
                                 }
                                ?>
                                <td><?php echo $row['rend'];?></td>
                            </tr>
                    <?php
                        }
                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where vendedor = 'Mostrador' and fechaventa between '$fechaini' and '$fechafin'";
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
                        $query= "SELECT sum(comision) as com, sum(precioventa) as ventas, sum(preciocompra) as invrec, sum(comisionimp) as comimp, sum(rendimiento) as rend FROM cat_ventas where fechaventa between '$fechaini' and '$fechafin'";
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
                        }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
     <script src="bt/js/bootstrap.bundle.min.js"></script>
</body>
</html>