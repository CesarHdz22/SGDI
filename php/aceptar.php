<?php
include("conexion.php");

$id = $_GET['id'];


$sql_update = "UPDATE examenes SET estado = 'aceptado' WHERE Matricula = ?";

$stmt = mysqli_prepare($conexion, $sql_update);
mysqli_stmt_bind_param($stmt, 's', $id);

if (mysqli_stmt_execute($stmt)) {
    $sql_insert_estado = "INSERT INTO estado (Matricula, estado) VALUES (?, 'aceptado')";
    $stmt_insert = mysqli_prepare($conexion, $sql_insert_estado);
    mysqli_stmt_bind_param($stmt_insert, 's', $id);

    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<script>
                alert('El Alumno ha sido aceptado');
                window.history.go(-1);
              </script>";
    } else {
        echo "<script>
                alert('Error al insertar en la tabla estado: " . mysqli_error($conexion) . "' );
                window.history.go(-1);
              </script>";
    }
} else {
    echo "<script>
            alert('Error al actualizar el estado en la tabla examenes: " . mysqli_error($conexion) . "' );
            window.history.go(-1);
          </script>";
}

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt_insert);
mysqli_close($conexion);
?>
