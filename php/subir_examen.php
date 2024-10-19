<?php
session_start();
include("conexion.php");

$id = $_SESSION['Id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archivo_examen = $_FILES['foto_examen']['tmp_name'];

    if ($archivo_examen) {
        $examen_data = file_get_contents($archivo_examen);

        $examen_data = mysqli_real_escape_string($conexion, $examen_data);

        $sql = "INSERT INTO examenes (Matricula, examen, estado) VALUES (?, ?, 'rechazado')";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $id, $examen_data);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Foto del examen subida con éxito.');
                    window.history.go(-1);
                  </script>";
        } else {
            echo "<script>
                    alert('Error al guardar la foto del examen en la base de datos: " . mysqli_error($conexion) . "');
                    window.history.go(-1);
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error al cargar el archivo de la foto del examen.');
                window.history.go(-1);
              </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
