<?php
include_once("conexion.php");

if (isset($_POST['eliminar_fila'])) {
    

    $id=$_POST["id"];
    $sentencia = "DELETE FROM auxiliar where idaux = '$id'";
    $resultado = mysqli_query ($conexion, $sentencia);
    if($resultado){
        return header("Location: formularioventas.php");
    }
    else{
        return "error";
    }
}

if (isset($_POST['eliminar_filacom'])) {
    

    $id=$_POST["id"];
    $sentencia = "DELETE FROM auxcom where idcomprasaux = '$id'";
    $resultado = mysqli_query ($conexion, $sentencia);
    if($resultado){
        return header("Location: formulariocompras.php");
    }
    else{
        return "error";
    }
}

    ?>
