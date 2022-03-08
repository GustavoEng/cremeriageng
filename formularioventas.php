<?php
    include 'conexion.php';
    include("menu.php");
    $cont = 0;
    
    $consulta = "SELECT descripcion FROM cat_producto";
    $resultado = $conexion->query($consulta);
    $array = array();
    if($resultado){
        while ($row = mysqli_fetch_array($resultado)){
            $modelo = $row['descripcion'];
            array_push($array, $modelo);
        }
    }



  if (isset($_POST['agregar_prod'])) {
    
  		$nombreprod = $_POST['nombreprod'];
  		$cantidad = $_POST['cantidad'];
          $tipoventa = $_POST['tipoventa'];
        
          $queryini = "select * from cat_producto where descripcion = '$nombreprod'";
          $resultado = $conexion->query($queryini);
          if($resultado){
              while ($row = mysqli_fetch_array($resultado)){
              $idprod = $row['idproducto'];
              if($tipoventa == 1){
                $precioventa = $row['preciopublico'] * $cantidad;
              }

              if($tipoventa == 2){
                $precioventa = $row['preciomayoreo'] * $cantidad;
              }

              if($tipoventa == 3){
                $precioventa = $row['preciopreferente'] * $cantidad;
              }
              
              $preciocompra = $row['preciocompra'] * $cantidad;
              $ganancia = $precioventa - $preciocompra;
              $rendimiento = $ganancia * .3;
              $comision = $ganancia * .7;
                  
          }
          }
          
  		$query = "INSERT INTO auxiliar (idproducto, precioventa, preciocompra, comision, rendimiento, comisionimp, cantidad, vendedor, tipoventa, fechaventa) VALUES('$idprod', '$precioventa','$preciocompra','$ganancia','$rendimiento','$comision', '$cantidad', '', '$tipoventa', now())";

      $resultado = $conexion->query($query);
          
          //$query1 = "update cat_producto set existencias = existencias - '$cantidad' where descripcion = '$nombreprod'";
          
          //$resultado1 = $conexion->query($query1);

  		
      
  	}
  
 if (isset($_POST['limpiar_tabla'])) {

    $query = "truncate auxiliar";
    $resultado = $conexion->query($query);


 }

 if (isset($_POST['agregar_tiket'])) {

  $query = "SELECT MAX(idaux) AS id FROM auxiliar";
          $resultado = $conexion->query($query);

          

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

      $vendedor = $_POST['vendedor'];
      $cliente = $_POST['clientevent'];

    $query = "select sum(precioventa) as total from auxiliar";
    $resultado = $conexion->query($query);

    if($resultado){
        ?>
        <div class="alert alert-success" role="alert">
            Venta Registrada Exitosamente
        </div>
      <?php
        }
        else{
          echo "fallo";
        }
    while ($row = mysqli_fetch_array($resultado)){
              $total = $row['total'];
                  
          }


          $query = "INSERT INTO tickets (cliente, vendedor, totalventa, fechaticket) VALUES('$cliente', '$vendedor', '$total', now())";
          $resultado = $conexion->query($query);

          if($resultado){
        ?>
        <div class="alert alert-success" role="alert">
            Venta Registrada Exitosamente
        </div>
      <?php
        }
        else{
          echo "fallo";
        }

          $query = "SELECT MAX(idticket) AS id FROM tickets";
          $resultado = $conexion->query($query);

          if($resultado){
        ?>
        <div class="alert alert-success" role="alert">
            Venta Registrada Exitosamente
        </div>
      <?php
        }
        else{
          echo "fallo";
        }

          while ($row = mysqli_fetch_array($resultado)){
              $idtiket = $row['id'];    
          }

          
        $query = "INSERT into cat_ventas(idproducto, idticket, precioventa, preciocompra, comision, rendimiento, comisionimp, cantidad, vendedor, tipoventa, fechaventa) 
            select idproducto, '$idtiket', precioventa, preciocompra, comision, rendimiento, comisionimp, cantidad, '$vendedor', tipoventa, fechaventa 
            from auxiliar";
          $resultado = $conexion->query($query);

          if($resultado){
        ?>
        <div class="alert alert-success" role="alert">
            Venta Registrada Exitosamente
        </div>
      <?php
        }
        else{
          echo "fallo";
        }


          $query = "SELECT count(idproducto) as cont from auxiliar";
            $resultado = $conexion->query($query);
            while ($row = mysqli_fetch_array($resultado)){

              $contador = $row['cont'];
            }

          $query= "SELECT * FROM auxiliar";
          $resultado = $conexion->query($query);
            while($row=$resultado->fetch_assoc())
            {
                $cantidad[$cont] = $row['cantidad'];
                $idprod[$cont] = $row['idproducto'];
                $cont++;
            }

            for ($i=0; $i < $contador; $i++) {

                $query1= "update cat_producto set existencias = existencias - '$cantidad[$i]' where idproducto = '$idprod[$i]' ";
                $resultado = $conexion->query($query1);

            }


          $query = "truncate auxiliar";
          $resultado = $conexion->query($query);

          if($resultado){
        ?>
        <div class="alert alert-success" role="alert">
            Venta Registrada Exitosamente
        </div>
      <?php
        }
        else{
          echo "fallo";
        }
        }

 }
  





?>
<!doctype html>
<html>
  <head>
      <title>Ventas</title>
    
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
          <h5><b>Modúlo De Ventas</b></h5>
      </div>
      </br>
      
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
				<table class="table table-hover table-striped">
          <div>


           
                    
            

          </div>
					<tr class="fila-fija">
						<td><input required name="nombreprod" id="tag" placeholder="Producto" class="form-control"/></td>
						<td><input  required name="cantidad" placeholder="Cantidad" class="form-control"/></td>
						<td><select name="tipoventa" class="form-control">
                            <option value="1" selected>Precio Público</option>
                            <option value="2" >Precio Mayoreo</option>
                            <option value="3" >Precio Preferente</option>
                            </select></td>
					</tr>
				</table>
        <div class="form-group float-right">
					<input type="submit" name="agregar_prod" value="Agregar Producto" class="btn btn-primary btn pull-right" id="agregar_prod" />
				</div>
		  </form>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
          
        </br>
          <div class="form-group">
            <div class="row">


            </div>
          </div>
          <div class="form-group">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                         $query= "SELECT * FROM auxiliar as aux INNER JOIN cat_producto as pro ON aux.idproducto=pro.idproducto";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td><?php echo $row['idaux'];?></td>
                                <td><?php echo $row['cantidad'];?></td>
                                <td><?php echo $row['descripcion'];?></td>
                                <td>
                                  <?php if ($row['tipoventa'] == 1){echo $row['preciopublico'];}?>
                                  <?php if ($row['tipoventa'] == 2){echo $row['preciomayoreo'];}?>
                                  <?php if ($row['tipoventa'] == 3){echo $row['preciopreferente'];}?>
                                </td>
                                <td><?php echo $row['precioventa'];?></td>
                                <td><button type="button" class="btn btn-outline-danger delbtn" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar</button></td>
                            </tr>
                    <?php
                        }

                        


                        $query= "SELECT sum(precioventa) as total FROM auxiliar";
                            $resultado = $conexion->query($query);
                            while($row=$resultado->fetch_assoc())
                            {
                    ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total</b></td>
                                <td id="total"><?php echo $row['total'];?></td>
                                <td></td>
                            </tr>
                    <?php
                        }
                    ?>

                </tbody>
            </table>
            </br>
            <div class="form-group float-right">
              <input type="submit" name="limpiar_tabla" value="Limpiar Tabla" class="btn btn-primary btn pull-right" id="limpiar_tabla" />
                <input type="button" value="Generar Cobro" class="btn btn-primary btn pull-right" id="agregar_tiket" data-bs-toggle="modal" data-bs-target="#cobro" />
            </div>

          </form>
          </div>
         </div>


 <!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <form action="eliminarprodticket.php" method="POST">
          <input type="hidden" name="id" id="del_id">
            <h2>Desea eliminar de la lista?</h2>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="submit" name="eliminar_fila" class="btn btn-primary">Si</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal cobro -->
<div class="modal fade" id="cobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            
            <h2>Desea guardar venta?</h2>
            <div class="form-group">
              <select required name="vendedor" class="form-control" select style="width:200px">
                <option value="" selected>Seleccionar Vendedor</option>
                <option value="Mostrador1" >Mostrador 1</option>
                <option value="Mostrador2" >Mostrador 2</option>
              </select>
            </div>

            <div class="form-group">
              <input type="text" name="clientevent" placeholder="Cliente" value="" class="form-control" required>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="submit" name="agregar_tiket" class="btn btn-primary">Si</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>




        <script type="text/javascript">
          $(document).ready(function (){
              var items = <?= json_encode($array) ?>
            
              $("#tag").autocomplete({
                  source: items
              });
          });
           
      </script>
      <script type="text/javascript">
          function confirmarventa()
          {
              var respuesta = confirm("Esta seguro de guardar la venta?");
              
              if(respuesta == true)
                  {
                      return true;
                  }
              else
              {
                  return false;
              }
          }
      </script>


      <script>
        $('.delbtn').on('click',function(){
        
        $tr=$(this).closest('tr');
        var datos = $tr.children("td").map(function(){
           return $(this).text();
        });
        
        $('#del_id').val(datos[0]);
        
    });
    </script>
    
      
      <script src="bt/js/bootstrap.bundle.min.js"></script>
      <script src="popper/popper.min.js"></script>

      
  </body>
</html>

