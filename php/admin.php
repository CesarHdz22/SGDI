<?php
include("conexion.php");



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<header>
    <h1>Bienvenido </h1>
    <nav class="user-menu">
        <ul>
            <li><a href="logout.php">Cerrar sesión</a></li> 
        </ul>
    </nav>
</header>

<div class="container">
    <div class="menu">
        <button onclick="mostrarSeccion('seccion1')">Pre Registro</button>
        <button onclick="mostrarSeccion('seccion2')">Comprobantes de Pago</button>
        <button onclick="mostrarSeccion('seccion3')">Puntaje de examen</button>
    </div>

    <table id="seccion1" style="display: table;">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Curp</th>
                <th>Aceptar</th>
                <th>Rechazar</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $sql="SELECT * FROM preregistro";
            $result=mysqli_query($conexion,$sql);
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['Matricula']; ?></td>
                <td><?php echo $mostrar['Nombre']; ?></td>
                <td><?php echo $mostrar['Carrera']; ?></td>
                <td><?php echo $mostrar['Correo']; ?></td>
                <td><?php echo $mostrar['Telefono']; ?></td>
                <td><?php echo $mostrar['Direccion']; ?></td>
                <td><a href="ver_archivo.php?id=<?php echo $mostrar['Matricula']; ?>">Ver archivo</a></td>
                <td class="actions"><a href="aceptar_soli.php?id=<?php echo $mostrar['Matricula']; ?>"><button>Aceptar</button></a></td>
                <td class="actions"><a href="rechazar_soli.php?id=<?php echo $mostrar['Matricula']; ?>"><button class="reject-btn" style="background-color: #dc3545;">Rechazar</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <table id="seccion2" style="display: none;">
        <thead>
            <tr>
                <th>Matrícula del Alumno</th>
                <th>Comprobante de Examen</th>
                <th>Comprobante de Inscripcion</th>
                <th>Aceptar</th>
                <th>Rechazar</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $sql="SELECT * FROM comprobantes WHERE estado = 'rechazado'";
            $result=mysqli_query($conexion,$sql);
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['Matricula']; ?></td>

                <td><a href="ver_cexamen.php?id=<?php echo $mostrar['Matricula']; ?>">Ver archivo</a></td>
                <td><a href="ver_cinscripcion.php?id=<?php echo $mostrar['Matricula']; ?>">Ver archivo</a></td>
                <td class="actions"><a href="aceptar_pago.php?id=<?php echo $mostrar['Matricula']; ?>"><button>Aceptar</button></a></td>
                <td class="actions"><a href="rechazar_pago.php?id=<?php echo $mostrar['Matricula']; ?>"><button class="reject-btn" style="background-color: #dc3545;">Rechazar</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <table id="seccion3" style="display: none;">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Ver examen</th>
                <th>Aceptar</th>
                <th>Rechazar</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $sql="SELECT * FROM examenes WHERE estado = 'rechazado'";
            $result=mysqli_query($conexion,$sql);
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['Matricula']; ?></td>
                <td><a href="ver_examen.php?id=<?php echo $mostrar['Matricula']; ?>">Ver archivo</a></td>
                <td class="actions"><a href="aceptar.php?id=<?php echo $mostrar['Matricula']; ?>"><button>Aceptar</button></a></td>
                <td class="actions"><a href="rechazar.php?id=<?php echo $mostrar['Matricula']; ?>"><button class="reject-btn" style="background-color: #dc3545;">Rechazar</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function mostrarSeccion(seccion) {
        
        document.getElementById("seccion1").style.display = 'none';
        document.getElementById("seccion2").style.display = 'none';
        document.getElementById("seccion3").style.display = 'none';

        document.getElementById(seccion).style.display = 'table';

        var buttons = document.querySelectorAll('.menu button');
        buttons.forEach(function(button) {
            button.classList.remove('active');
        });

        event.target.classList.add('active');
    }

  
    window.onload = function() {
        mostrarSeccion('seccion1');
    };

    
</script>



</body>
</html>
