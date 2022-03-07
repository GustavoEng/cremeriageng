<?php
include("conexion.php");
include("menu.php");
$cont = 0;

$query = "select * from cat_producto";
$resultado = $conexion->query($query);

$array = array();
if ($resultado){
    while ($row = mysqli_fetch_array($resultado)){
        $productos = $row['descripcion'];
        array_push($array, $productos);
    }
}

 if (isset($_POST['agregar_prod'])) {
    
        $nombreprod = $_POST['nombreprod'];
        $preciocompranuevo = $_POST['preciocompranuevo'];
        $cantidad = $_POST['cantidad'];
        $subtotal= $preciocompranuevo * $cantidad;
          $queryini = "select * from cat_producto where descripcion = '$nombreprod'";
          $resultado = $conexion->query($queryini);
          if($resultado){
              while ($row = mysqli_fetch_array($resultado)){
              $idprod = $row['idproducto'];
              $preciocompra = $row['preciocompra'];
          }
          }
          
        $query = "INSERT INTO auxcom (idprod, preciocompraant, preciocompraact, cantidad, fechaticket, subtotal) VALUES('$idprod', '$preciocompra', '$preciocompranuevo', '$cantidad', now(), $subtotal)";

        $resultado = $conexion->query($query);
        if($resultado){
        echo "exito";
            }
        else{
            echo "fallo";
             }
    }


    if (isset($_POST['agregar_tiket'])) {

  $query = "SELECT MAX(idcomprasaux) AS id FROM auxcom";
          $resultado = $conexion->query($query);
          $proveedor = $_POST['proveedor'];
          while ($row = mysqli_fetch_array($resultado)){
              $list = $row['id'];    
          }


          if($list == null)
          {
            echo $list;
          echo "fallo";
          }
      else
          {
            $query = "SELECT sum(subtotal) as total, sum(cantidad) as totalprod, count(idprod) as cont from auxcom";
            $resultado = $conexion->query($query);
            while ($row = mysqli_fetch_array($resultado)){
            $total = $row['total'];
            $totalprod = $row['totalprod'];
            $cont1 = $row['cont'];
                  
          }


          $query = "INSERT INTO ticketscom (proveedor, cantidadproductos, totalcompra, fechaticketcom) VALUES('$proveedor', '$totalprod', '$total', now())";
          $resultado = $conexion->query($query);

          $query = "SELECT MAX(idticketcom) AS id FROM ticketscom";
          $resultado = $conexion->query($query);

          while ($row = mysqli_fetch_array($resultado)){
              $idtiket = $row['id'];    
          }

          
            $query = "INSERT into cat_compras(idprod, idticketcom, preciocompraant, preciocompraact, cantidad, fechaticket) 
            select idprod, '$idtiket', preciocompraant, preciocompraact, cantidad, fechaticket 
            from auxcom";
            $resultado = $conexion->query($query);


            $query= "SELECT * FROM auxcom";
            $resultado = $conexion->query($query);
            while($row=$resultado->fetch_assoc())
            {
                $cantidad[$cont] = $row['cantidad'];
                $idprod[$cont] = $row['idprod'];
                $cont++;

            }

            for ($i=0; $i < $cont1; $i++) {

                $query1= "update cat_producto set existencias = existencias + '$cantidad[$i]' where idproducto = '$idprod[$i]' ";
                $resultado = $conexion->query($query1);

            }


          $query = "truncate auxcom";
          $resultado = $conexion->query($query);

          if($resultado){
        echo "exito";
      }
      else{
        echo "fallo";
      }
      }

 }




 if (isset($_POST['limpiar_tabla'])) {

    $query = "truncate auxcom";
    $resultado = $conexion->query($query);
 }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Aqua Pet | Ingresar Mercancia</title>

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
            <h5><b>Ingresar Mercancia Nueva</b></h5>
            <h7>Ingresar la cantidad de mercancia comprada de acuerdo al ticket</h7>
        </div>
        </br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="nombreprod" id="tag" placeholder="Producto" value="" class="form-control" required>
                    </div>
                    <div class="col-4">
                        <input type="text" name="preciocompranuevo" placeholder="Precio Compra" value="" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="button" onclick="decrementar()" class="btn btn-secondary">-</button>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" value="" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="button" onclick="incrementar()" class="btn btn-secondary">+</button>
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                <input type="submit" value="Agregar" id="agregar_prod" name="agregar_prod" class="btn btn-primary btn pull-right"/>
            </div>
		    </form>
            

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio Compra Anterior</th>
                        <th>Precio Compra Acutal</th>
                        <th>Precio Público</th>
                        <th>Subtotal</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                         $query= "SELECT * FROM auxcom as aux INNER JOIN cat_producto as pro ON aux.idprod=pro.idproducto";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td hidden="true"><?php echo $row['idcomprasaux'];?></td>
                                <td hidden="true"><?php echo $row['idproducto'];?></td>
                                <td><?php echo $row['cantidad'];?></td>
                                <td><?php echo $row['descripcion'];?></td>
                                <td><?php echo $row['preciocompra'];?></td>
                                <td><?php echo $row['preciocompraact'];?></td>
                                <td><?php echo $row['preciopublico'];?></td>
                                <td hidden="true"><?php echo $row['preciopreferente'];?></td>
                                <td hidden="true"><?php echo $row['preciomayoreo'];?></td>
                                <td><?php echo $row['subtotal'];?></td>
                                <td>
                                    <?php
                                    if($row['preciocompraact'] != $row['preciocompra'] )
                                    {
                                    ?>
                                    <button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Modificar</button>
                                    <?php
                                    }
                                    ?>
                                </td>

                                <td><button type="button" class="btn btn-danger delbtn" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar</button></td>
                            </tr>
                    <?php
                        }

                        


                        $query= "SELECT sum(subtotal) as total FROM auxcom";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td><b>Total</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="total"><?php echo $row['total'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                    <?php
                        }
                    ?>

                </tbody>
            </table>
            <div class="form-group">
            <div class="row">
                    <div class="col-12" align="right">
                        <input type="button" value="Limpiar Tabla" class="btn btn-primary btn pull-right" data-bs-toggle="modal" data-bs-target="#limpiar" />
                    </div>
            </div>
            </div>
            </form>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <div class="form-group">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-4" align="right">
                        <input type="text" name="proveedor" placeholder="Ingresar Proveedor" value="" class="form-control" required>
                    </div>
                    <div class="col-2" align="right">
                        <input type="submit" value="Registrar Mercancia" class="btn btn-primary btn pull-right" name="agregar_tiket" />
                    </div>
                </div>
                </div>
                
            </form>


        <!-- Modal Eliminar Todos los registros -->
        <div class="modal fade" id="limpiar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Limpiar Tabla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                  <input type="hidden" name="id" id="del_id">
                    <h2>¿Desea borrar los articulos agregados?</h2>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="limpiar_tabla">Si</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

                <!-- Modal Eliminar Fila -->
        <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                  <form action="eliminarprodticket.php" method="POST">
                  <input type="hidden" name="id" id="del_row">
                    <h2>Desea eliminar de la lista?</h2>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="eliminar_filacom" class="btn btn-primary">Si</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>


                <!-- Modal Modificar Precios -->
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
                      <label for="">Descripción</label>
                      <input type="text" name="descripcion" id="descripcion" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="">Precio Publico</label>
                      <input type="text" name="precio" id="precio" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="">Precio Compra</label>
                        <input type="text" name="preciocompra" id="preciocompra" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="">Precio Preferente</label>
                        <input type="text" name="preciopreferente" id="preciopreferente" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="">Precio Mayoreo</label>
                        <input type="text" name="preciomayoreo" id="preciomayoreo" class="form-control">
                  </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editar_prod_com" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>




        <script type="text/javascript">

            function incrementar() {
            valor = document.getElementById("cantidad");
            if (valor.value < 100)valor.value ++;
            }
             
            function decrementar() {
            valor = document.getElementById("cantidad");
            if (valor.value > 1)valor.value --;
            }

        
            $(document).ready(function (){
                var items = <?= json_encode($array); ?>
                    
                $("#tag").autocomplete({
                    source: items
                });
            });
        </script>


      <script>
        $('.delbtn').on('click',function(){
        
        $tr=$(this).closest('tr');
        var datos = $tr.children("td").map(function(){
           return $(this).text();
        });
        
        $('#del_row').val(datos[0]);
        
    });
    </script>

    <script>
    $('.editbtn').on('click',function(){
        
        $tr=$(this).closest('tr');
        var datos = $tr.children("td").map(function(){
           return $(this).text();
        });
        
        $('#update_id').val(datos[1]);
        $('#descripcion').val(datos[3]);
        $('#precio').val(datos[6]);
        $('#preciocompra').val(datos[5]);
        $('#preciopreferente').val(datos[7]);
        $('#preciomayoreo').val(datos[8]);
    });
    </script>


        <script src="bt/js/bootstrap.bundle.min.js"></script>
      
    </div>
</body>
</html>