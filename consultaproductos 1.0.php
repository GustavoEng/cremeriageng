<?php 
if (isset($_POST['submit'])) {
	$mar = $_POST['marca'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consultar Productos</title>
    
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

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
               <a class="navbar-brand" href="#">
                   <img src="img/aqlogo.png" width="30" height="30" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav">
                      <li class="nav-item active">
                          <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="formularioventas.php">Ventas</a>
                      </li>
                          <li class="nav-item">
                          <a class="nav-link" href="formulariocompras.php">Copras</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="consultaproductos.php">Consultar Productos</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Registros
                          </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="formularioproductos.php">Registrar Producto</a>
                            <a class="dropdown-item" href="formulariotipo.php">Registrar Tipo</a>
                            <a class="dropdown-item" href="formulariomarca.php">Registrar Marca</a>
                            <a class="dropdown-item" href="formclasificacion.php">Registrar Clasificación</a>
                        </div>
                      </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Consultas
                      </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="consultarventas.php">Ventas</a>
                        <a class="dropdown-item" href="consultarcompras.php">Compras</a>
                        </div>
                    </li>
                    </ul>
                  </div>
            </nav>
        </div>
    
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        
                        <select name="marca" class="form-control">
                                <?php
                                    include 'conexion.php';
                                    $consulta = "SELECT * FROM cat_marca";
                                    $ejecutar=mysqli_query($conexion,$consulta) or die(mysql_error($conexion));
                                ?>
                                <option value="" selected>Seleccione marca</option>
                                <?php foreach ($ejecutar as $opciones): ?>
                                    <option value="<?php echo $opciones['id']?>"><?php echo $opciones['nombremarca']?></option>
                                <?php endforeach ?>
                            </select>
                </div>
                <div class="col-4">
                    <input class="form-check-input" type="checkbox" value="1" id="check" name="check">
                    <label class="form-check-label" for="check">
                        Mostrar todos
                    </label>
                </div>
                </div>
            </div>
            <div class="form-group float-right">
                <button name="submit" type="submit" class="btn btn-primary btn pull-right">Buscar</button>
            </div>
        </form>
        
           
        
   
        <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        
                        <th>Modelo</th>
                        <th>descripcion</th>
                        <th>existencias</th>
                        <th>precio</th>
                        <th>precio may</th>
                        <th>precio compra</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                    if(empty($mar))
                    {
                        
                    }
                    else
                    {
                        $query= "SELECT pro.idproducto, pro.modelo, 
                                        pro.descripcion, 
                                        pro.existencias, 
                                        pro.preciopublico, 
                                        pro.preciomayoreo, 
                                        pro.preciocompra, 
                                        mar.nombremarca  
                                        FROM cat_producto as pro 
                                        INNER JOIN cat_marca as mar ON pro.idmarca=mar.id where idmarca=$mar";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['idproducto'];?></td>
                            
                            <td><?php echo $row['modelo'];?></td>
                            <td><?php echo $row['descripcion'];?></td>
                            <td><?php echo $row['existencias'];?></td>
                            <td><?php echo $row['preciopublico'];?></td>
                            <td><?php echo $row['preciomayoreo'];?></td>
                            <td><?php echo $row['preciocompra'];?></td>
                            <td><button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Modificar</button></td>
                        </tr>
                    <?php
                        }}
                    ?>

                </tbody>
            </table>
            
        <a href="index.html"> Regresar</a>
        </div>
    </div>
    


<!-- Modal -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar producto</h5>
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
              <label for="">Precio publico</label>
              <input type="text" name="precio" id="precio" class="form-control">
          </div>
              <div class="form-group">
              <label for="">Precio mayoreo</label>
              <input type="text" name="preciomay" id="preciomay" class="form-control">
          </div>
        <div class="form-group">
                <label for="">Precio compra</label>
                <input type="text" name="preciocompra" id="preciocompra" class="form-control">
          </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
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
        
        $('#update_id').val(datos[0]);
        $('#modelo').val(datos[1]);
        $('#descripcion').val(datos[2]);
        $('#existencias').val(datos[3]);
        $('#precio').val(datos[4]);
        $('#preciomay').val(datos[5]);
        $('#preciocompra').val(datos[6]);
    });
    </script>
    
    
     <script src="bt/js/bootstrap.bundle.min.js"></script>
      
</body>
</html>