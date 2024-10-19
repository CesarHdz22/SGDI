<?php
session_start();
include("conexion.php");

$id = $_SESSION['Id'];

$sql_delete = "DELETE FROM comprobantes WHERE Matricula = ?";

$stmt = mysqli_prepare($conexion, $sql_delete);

mysqli_stmt_bind_param($stmt, 's', $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('Registro eliminado con éxito.');
            window.history.go(-1);
          </script>";
} else {
    echo "<script>
            alert('Error al eliminar el registro: " . mysqli_error($conexion) . "');
            window.history.go(-1);
          </script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
