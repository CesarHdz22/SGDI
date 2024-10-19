<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT c_examen FROM comprobantes WHERE Matricula = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $archivo_pdf = $row['c_examen']; 

        if ($archivo_pdf) {
            header('Content-Type: application/pdf'); 
            header('Content-Disposition: inline; filename="comprobante_examen.pdf"');
            echo $archivo_pdf;
        } else {
            echo "El archivo de comprobante de examen está vacío o no es válido.";
        }
    } else {
        echo "Comprobante de examen no encontrado.";
    }
} else {
    echo "ID no proporcionado.";
}
?>
    