<?php
session_start();
include("conexion.php");

$matricula = $_SESSION['Id'];
$nombre = $_SESSION['Nombre'];

$sql_comprobante = "SELECT estado FROM comprobantes WHERE Matricula = ?";
$stmt_comprobante = mysqli_prepare($conexion, $sql_comprobante);
mysqli_stmt_bind_param($stmt_comprobante, 's', $matricula);
mysqli_stmt_execute($stmt_comprobante);
$result_comprobante = mysqli_stmt_get_result($stmt_comprobante);
$row_comprobante = mysqli_fetch_assoc($result_comprobante);

$sql_examen = "SELECT estado FROM examenes WHERE Matricula = ?";
$stmt_examen = mysqli_prepare($conexion, $sql_examen);
mysqli_stmt_bind_param($stmt_examen, 's', $matricula);
mysqli_stmt_execute($stmt_examen);
$result_examen = mysqli_stmt_get_result($stmt_examen);
$row_examen = mysqli_fetch_assoc($result_examen);

$sql_estado = "SELECT estado FROM estado WHERE Matricula = ?";
$stmt_estado = mysqli_prepare($conexion, $sql_estado);
mysqli_stmt_bind_param($stmt_estado, 's', $matricula);
mysqli_stmt_execute($stmt_estado);
$result_estado = mysqli_stmt_get_result($stmt_estado);
$row_estado = mysqli_fetch_assoc($result_estado);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de Pagos - Alumnos</title>
    <link rel="stylesheet" href="../css/alumnos.css">
</head>
<body>

<header>
    <h1>Registro</h1>
</header>

<nav>
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <?php if ($row_estado && $row_estado['estado'] == 'aceptado'): ?>
        <h2>Resultados de la Inscripción</h2>
        <div class="resultado aceptado">
            <h3>Felicitaciones, <?php echo $nombre; ?></h3>
            <p>Has sido aceptado.</p>
        </div>

    <?php elseif ($row_estado && $row_estado['estado'] == 'rechazado'): ?>
        <h2>Resultados de la Inscripción</h2>
        <div class="resultado rechazado">
            <h3>Lo sentimos, <?php echo $nombre; ?> </h3>
            <p>No has sido aceptado.</p>
        </div>

    <?php elseif ($row_comprobante && $row_comprobante['estado'] == 'aceptado' && (!$row_examen || $row_examen['estado'] != 'rechazado')): ?>
       
        <h2>Subir Foto del Examen</h2>
        <form action="subir_foto_examen.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="foto_examen">Subir foto del examen con los puntos:</label>
                <input type="file" name="foto_examen" id="foto_examen" required>
            </div>
            <input type="submit" value="Subir Foto">
        </form>

    <?php elseif ($row_examen && $row_examen['estado'] == 'rechazado'): ?>
       
        <h2>Espere que comprueben sus documentos</h2>
        <p>Su solicitud está en revisión por el momento. Por favor espere a que se validen sus documentos.</p>

    <?php elseif ($row_comprobante && $row_comprobante['estado'] == 'rechazado'): ?>
        
        <h2>Espere que comprueben sus documentos</h2>
        <p>Su solicitud está en revisión por el momento. Por favor espere a que se validen sus documentos.</p>

    <?php else: ?>
        
        <h2>Subida de Comprobante de Pagos</h2>
        <form action="subir_pago.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="pago_examen">Subir comprobante de pago del examen:</label>
                <input type="file" name="pago_examen" id="pago_examen" required>
            </div>
            <div>
                <label for="pago_admision">Subir comprobante de pago de la inscripción:</label>
                <input type="file" name="pago_admision" id="pago_admision" required>
            </div>
            <input type="submit" value="Subir Pagos">
        </form>
    <?php endif; ?>
</div>

</body>
</html>
