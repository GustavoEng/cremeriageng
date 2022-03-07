<?php
include 'conexion.php';
 
$marc=$_POST['marc'];

 
$consulta = "SELECT pro.id, 
                pro.idmarca, 
                pro.nombre 
                FROM cat_productos as pro 
                WHERE idmarca = '$marc'";

 $resultadoM = mysqli_query($conexion, $consulta);

$cadena="<label>Producto</label>
         <select id='idproducto' name='idproducto' class='form-control'>";

     
	while($row = mysqli_fetch_row($resultadoM))
	{
		$cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[2]).'</option>';
	}
	
	echo $cadena."</select>";

?>
