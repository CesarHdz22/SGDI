<?php
include("conexion.php");

$id = $_GET['id'];

$sql_update = "UPDATE comprobantes SET estado = 'aceptado' WHERE Matricula = ?";


$stmt = mysqli_prepare($conexion, $sql_update);
mysqli_stmt_bind_param($stmt, 's', $id);

if (mysqli_stmt_execute($stmt)) {

    echo "<script>
            window.history.go(-1);
          </script>";
} else {
   
    echo "<script>
            alert('Error al actualizar el estado: " . mysqli_error($conexion) . "');
            window.history.go(-1);
          </script>";
}


mysqli_close($conexion);
?>
