<?php
include("conexion.php");

	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	$descripcion = $_POST['descripcion'];
	$estado = '0';

	$query = "INSERT INTO cat_tipo(nombre, clave, descripcion, estado) VALUES('$nombre', '$clave', '$descripcion', '$estado')";

	$resultado = $conexion->query($query);

	if($resultado){
		echo "exito";
	}
	else{
		echo "fallo";
	}
?>
