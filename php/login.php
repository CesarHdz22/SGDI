<?php
session_start();
include("conexion.php");


if(!empty($_POST['username']) && !empty($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    
    $consulta="SELECT * FROM usuarios WHERE User='$username' AND Pass='$password'";
    
    $resultado=mysqli_query($conexion,$consulta);
    $filas=mysqli_num_rows($resultado);
    
    while($row=mysqli_fetch_assoc($resultado)) {
    
    $id=$row["Id"];
    $nombre=$row["Nombre"];
    $cargo=$row["Cargo"];

    $_SESSION['Id']=$id;
    $_SESSION['Nombre']=$nombre;
    
    }
    
    if($filas > 0 ){
        if($cargo == "Admin"){
            header('location: admin.php');
        }else{
            header('location: alumnos.php');
        }
    
    }
    
    echo "<script>alert('Usuario Inexistente'); window.history.go(-1);</script>";
    
    }else{
    
        echo "<script>alert('Favor de llenar todos los datos'); window.history.go(-1);</script>";
    }
    
    