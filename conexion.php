<?php 

	/*$servidor="localhost";
	$usuario="root";
	$pass="";
	$bd="cremeria";*/

	$servidor="byhlhksaujskec351zn6-mysql.services.clever-cloud.com";
	$usuario="udc4jt5hsyj6jer5";
	$pass="bpxTJEqqmSSQarKmqvKg";
	$bd="byhlhksaujskec351zn6";

	$conexion = mysqli_connect($servidor,$usuario,$pass,$bd) or die(mysqli_error());
	/*if($conexion){
		echo "exito";
	}
	else{
		echo "fallo";
	}*/
 ?>