<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['carrera']) && !empty($_POST['correo']) &&
    !empty($_POST['telefono']) && !empty($_POST['direccion']) &&
    !empty($_POST['municipio']) && !empty($_POST['estado']) && !empty($_FILES['archivo_curp']['name'])) {
    

    $nombre = $_POST['nombre'];
    $carrera = $_POST['carrera'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['estado'] . " " . $_POST['municipio'] . " " . $_POST['direccion'];

    $archivo_curp = $_FILES['archivo_curp']['tmp_name']; 
    $curp_data = file_get_contents($archivo_curp); 
    $curp_data = mysqli_real_escape_string($conexion, $curp_data); 

    $sql = "INSERT INTO preregistro (nombre, carrera, correo, telefono, direccion, curp) 
            VALUES ('$nombre', '$carrera', '$correo', '$telefono', '$direccion', '$curp_data')";

    if ($resultado = mysqli_query($conexion, $sql)) {
        echo "<script>alert('Pre-Registro enviado con éxito'); window.location.href = '../index.html';</script>";
    } else {
        echo "<script>alert('Error al enviar el Pre-Registro'); window.history.go(-1);</script>";
    }

} else {
    echo "<script>alert('Favor de llenar todos los campos'); window.history.go(-1);</script>";
}
?>
