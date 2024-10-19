<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT Curp FROM preregistro WHERE Matricula = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $archivo_pdf = $row['Curp']; 

        if ($archivo_pdf) {
            
            header('Content-Type: application/pdf'); 
            header('Content-Disposition: inline; filename="archivo.pdf"'); 
            echo $archivo_pdf;
        } else {
            echo "El archivo está vacío o no es válido.";
        }
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "ID no proporcionado.";
}
?>
