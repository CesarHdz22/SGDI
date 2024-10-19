<?php
include("conexion.php");


$id = $_GET['id'];


$sql = "SELECT * FROM preregistro WHERE Matricula = '$id'";
$result = mysqli_query($conexion, $sql);

if ($result && $mostrar = mysqli_fetch_array($result)) {
    $telefono = "+52".$mostrar['Telefono'];
    $nombre = $mostrar['Nombre'];

    $nombreLimpio = preg_replace('/\s+/', '', $nombre); 
    $user = strtolower(substr($nombreLimpio, 0, 6)) . $id;

    $pass = bin2hex(random_bytes(4)); 


    echo "<script>
    var phonenumber = '".$telefono."'; // Formatear número de teléfono
    var user = '".$user."';
    var pass = '".$pass."';
    
    // Crear la URL para enviar el mensaje de WhatsApp
    var url = 'https://wa.me/' + phonenumber + '?text='
        + '*Usuario:* ' + user + '%0a'
        + '*Contraseña:* ' + pass + '%0a'
        + 'Estas son tus credenciales de inicio de sesión en la plataforma';
    
    console.log('URL generada: ', url); // Verificar la URL generada
    window.open(url, '_blank').focus();
        
        
    </script>";

    
    $sql_insert = "INSERT INTO usuarios (User, Pass, Nombre, Cargo) VALUES ('$user', '$pass', '$nombre', 'Alumno')";

    if (mysqli_query($conexion, $sql_insert)) {
        
        $sql_delete = "DELETE FROM preregistro WHERE Matricula = '$id'";

        if (mysqli_query($conexion, $sql_delete)) {
            echo "<script>
                alert('Usuario registrado y prerregistro eliminado exitosamente.');
                window.history.go(-1);
            </script>";
        } else {
            echo "<script>
                alert('Error al eliminar el usuario de la tabla de preregistro: " . mysqli_error($conexion) . "');
                window.history.go(-1);
            </script>";
        }
    } else {
        echo "<script>
            alert('Error al insertar el usuario en la base de datos: " . mysqli_error($conexion) . "');
            window.history.go(-1);
        </script>";
    }

} else {
    echo "<script>
        alert('No se encontró el usuario con la matrícula proporcionada.');
        window.history.go(-1);
    </script>";
}
?>
