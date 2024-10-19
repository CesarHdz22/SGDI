<?php
include("conexion.php");
$id = $_GET['id'];

$sql_delete = "DELETE FROM preregistro WHERE Matricula = '$id'";
if (mysqli_query($conexion, $sql_delete)) {
    $sql_estado = "INSERT INTO estado (Matricula, Estado) VALUES ('$id', 'Rechazado')";
    if (mysqli_query($conexion, $sql_estado)) {
        echo "<script> alert('Alumno rechazado'); window.history.go(-1); </script>";
        
    } else {
        echo "<script> alert('Error al eliminar el usuario de la tabla de preregistro: " . mysqli_error($conexion) . "'); window.history.go(-1); </script>";
    }
} else {
    echo "<script> alert('Error al eliminar el usuario de la tabla de preregistro: " . mysqli_error($conexion) . "'); window.history.go(-1); </script>";
}