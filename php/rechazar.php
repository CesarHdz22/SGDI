<?php
session_start();
include("conexion.php");

$id = $_SESSION['Id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql_delete = "DELETE FROM examenes WHERE Matricula = ?";
    $stmt_delete = mysqli_prepare($conexion, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, 's', $id);

    
    if (mysqli_stmt_execute($stmt_delete)) {
        
        $sql_insert_estado = "INSERT INTO estado (Matricula, estado) VALUES (?, 'rechazado')";
        $stmt_insert_estado = mysqli_prepare($conexion, $sql_insert_estado);
        mysqli_stmt_bind_param($stmt_insert_estado, 's', $id);

        
        if (mysqli_stmt_execute($stmt_insert_estado)) {

            echo "<script>
                    alert('El alumno ha sido rechazado');
                    window.history.go(-1);
                  </script>";
        } else {
            
            echo "<script>
                    alert('Error al actualizar el estado: " . mysqli_error($conexion) . "');
                    window.history.go(-1);
                  </script>";
        }

        
        mysqli_stmt_close($stmt_insert_estado);
    } else {
        
        echo "<script>
                alert('Error al rechazar el examen: " . mysqli_error($conexion) . "');
                window.history.go(-1);
              </script>";
    }

    
    mysqli_stmt_close($stmt_delete);
}


mysqli_close($conexion);
?>
