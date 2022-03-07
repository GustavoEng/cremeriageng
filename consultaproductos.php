<?php


include("conexion.php");

if (isset($_POST['submit'])) {
  $nombreprod = $_POST['nombreprod'];
  $mar = $_POST['marca'];
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
    <div class="form-group">
        <?php include("menu.php"); ?>
        </div>
    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="nombreprod" id="tag" placeholder="Producto" value="" class="form-control" >
                    </div>
                    <div class="col-4">
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
                <div>
                        <button name="submit" type="submit" class="btn btn-primary btn pull-right form-control">Buscar</button>
                </div>
            </div>
                        
            </div>
    </form>

<form action="editarproducto.php" method="POST" >
    <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                      <th>id</th>
                        <th>Descripción</th>
                        <th>Existencias</th>
                        <th>Precio Público</th>
                        <th>Precio Preferente</th>
                        <th>Precio Mayoreo</th>
                        <th>Precio Compra</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(empty($nombreprod))
                    {
                       
                    }
                        else{
                          $query= "SELECT * 
                                        FROM cat_producto where descripcion= '$nombreprod'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <input type="hidden" name="idmod" value="<?php echo $row['idproducto'];?>">
                        <tr>
                            <td><?php echo $row['idproducto'];?></td>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['existencias'];?></td>
                            <td><?php echo $row['preciopublico'];?></td>
                            <td><?php echo $row['preciopreferente'];?></td>
                            <td><?php echo $row['preciomayoreo'];?></td>
                            <td><?php echo $row['preciocompra'];?></td>
                            <td><button type="submit" class="btn btn-outline-success" name="modificar">Modificar</button></td>
                        </tr>
                    <?php 
                        }
                    }
                    ?>

                </tbody>
            </table>
            
          

            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                      <th>id</th>
                        <th>Modelo</th>
                        <th>Descripción</th>
                        <th>Existencias</th>
                        <th>Precio Público</th>
                        <th>Precio Mayoreo</th>
                        <th>Precio Compra</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(empty($mar))
                    {
                       
                    }
                        else{
                          $query= "SELECT pro.idproducto, pro.modelo, 
                                        pro.descripcion, 
                                        pro.existencias, 
                                        pro.preciopublico, 
                                        pro.preciomayoreo, 
                                        pro.preciocompra, 
                                        mar.nombremarca  
                                        FROM cat_producto as pro 
                                        INNER JOIN cat_marca as mar ON pro.idmarca=mar.id where idmarca = '$mar'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <input type="hidden" name="idmod" value="<?php echo $row['idproducto'];?>">
                        <tr>
                            <td><?php echo $row['idproducto'];?></td>
                            <td><?php echo $row['modelo'];?></td>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['existencias'];?></td>
                            <td><?php echo $row['preciopublico'];?></td>
                            <td><?php echo $row['preciomayoreo'];?></td>
                            <td><?php echo $row['preciocompra'];?></td>
                            <td><button type="submit" class="btn btn-outline-success" name="modificar">Modificar</button></td>
                        </tr>
                    <?php
                        }}
                    ?>

                </tbody>
            </table>
        
        </div>
        </form>
    </div>
        
        
        <script type="text/javascript">
        
            $(document).ready(function (){
                var items = <?= json_encode($array); ?>
                    
                $("#tag").autocomplete({
                    source: items
                });
            });
        
        </script>

    
    <script src="bt/js/bootstrap.bundle.min.js"></script>
      
    </div>
</body>
</html>