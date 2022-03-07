<?php
include_once("conexion.php");

if (isset($_POST['editar_prod'])) {
    $id=$_POST["id"];
    $modelo=$_POST["modelo"];
    $descripcion=$_POST["descripcion"];
    $existencias=$_POST["existencias"];
    $precio=$_POST["precio"];
    $preciomay=$_POST["preciomay"];
    $preciocompra=$_POST["preciocompra"];

    $sentencia = "UPDATE cat_producto SET modelo='".$_POST['modelo']."', descripcion='".$_POST['descripcion']."', existencias='".$_POST['existencias']."', preciopublico='".$_POST['precio']."', preciomayoreo='".$_POST['preciomay']."', preciocompra='".$_POST['preciocompra']."' where idproducto=".$_POST['id'].";";

    $resultado = mysqli_query ($conexion, $sentencia);

    if($resultado){

        return header("Location: consultaproductos.php");
    }
    else{
        return "error";
    }
}

if (isset($_POST['actualizar_producto'])) {

    $idprod = $_POST['idproducto'];
    $codigobarras = $_POST['codigobarras'];
    $existencias = $_POST['existencias'];
    $descripcion = $_POST['descripcion'];
    $pesounitario = $_POST['peso'];
    $preciocompra = $_POST['preciocompra'];
    $preciopublico = $_POST['preciopublico'];
    $preciomayoreo = $_POST['preciomayoreo'];
    $preciopreferente = $_POST['preciopreferente'];
    $estado = $_POST['estado'];
    $idmarca = $_POST['marca'];
    $idclasificacion = $_POST['clasificacion'];

    $sentencia = "UPDATE cat_producto SET codigobarras = '$codigobarras', existencias = '$existencias', descripcion = '$descripcion', pesounitario = '$pesounitario', preciocompra = '$preciocompra', preciopublico = '$preciopublico', preciomayoreo = '$preciomayoreo', preciopreferente = '$preciopreferente', estado = '$estado', idmarca = '$idmarca', idclasificacion = '$idclasificacion' where idproducto = '$idprod'";

    $resultado = mysqli_query ($conexion, $sentencia);

    if($resultado){

        return header("Location: consultaproductos.php");
    }
    else{
        return "error";
    }


}

if (isset($_POST['editar_prod_com'])) 
{
    $id=$_POST["id"];
    $descripcion=$_POST["descripcion"];
    $precio=$_POST["precio"];
    $preciocompra=$_POST["preciocompra"];
    $preciopreferente=$_POST["preciopreferente"];

    $sentencia = "UPDATE cat_producto SET descripcion = '$descripcion', preciopublico= '$precio', preciocompra = '$preciocompra', preciopreferente = '$preciopreferente' WHERE descripcion = '$descripcion'";

    $resultado = mysqli_query ($conexion, $sentencia);

    if($resultado){

        return header("Location: formulariocompras.php");
    }
    else{
        return "error";
    }

}

if (isset($_POST['editar_prod_aux'])) 
{
    $id=$_POST["id"];
    $descripcion=$_POST["descripcion"];
    $existencias=$_POST["existencias"];
    $precio=$_POST["precio"];
    $preciopreferente=$_POST["preciopreferente"];
    $preciomayoreo=$_POST["preciomayoreo"];
    $clasificacion=$_POST["clasificacion"];
    $estado=$_POST["estado"];

    $sentencia = "UPDATE cat_producto SET descripcion = '$descripcion',existencias ='$existencias', preciopublico= '$precio', preciopreferente = '$preciopreferente',preciomayoreo = '$preciomayoreo', idclasificacion = $clasificacion, estado = '$estado' WHERE idproducto = '$id'";

    $resultado = mysqli_query ($conexion, $sentencia);

    if($resultado){

        return header("Location: consultarprodfaltante.php");
    }
    else{
        return "error";
    }

}


?>

