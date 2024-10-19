<?php
session_start();
include("conexion.php");

$matricula = $_SESSION['Id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $archivo_foto_examen = $_FILES['foto_examen']['tmp_name'];
    $foto_examen_data = file_get_contents($archivo_foto_examen);
    $foto_examen_data = mysqli_real_escape_string($conexion, $foto_examen_data);

    $sql = "INSERT INTO examenes (Matricula, examen, estado) 
            VALUES ('$matricula', '$foto_examen_data', 'rechazado')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>window.history.go(-1);</script>";
    } else {
        echo "Error al guardar los datos: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
