<?php
session_start();
include("conexion.php");
$matricula = $_SESSION['Id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $archivo_inscripcion = $_FILES['pago_admision']['tmp_name'];
    $inscripcion_data = file_get_contents($archivo_inscripcion); 
    $inscripcion_data = mysqli_real_escape_string($conexion, $inscripcion_data); 

    $archivo_examen = $_FILES['pago_examen']['tmp_name']; 
    $examen_data = file_get_contents($archivo_examen); 
    $examen_data = mysqli_real_escape_string($conexion, $examen_data); 

    $sql = "INSERT INTO comprobantes (Matricula, c_inscripcion, c_examen, estado) 
            VALUES ('$matricula', '$inscripcion_data', '$examen_data','rechazado')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>window.history.go(-1);</script>";
    } else {
        echo "Error al guardar los datos: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
