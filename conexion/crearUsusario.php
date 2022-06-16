<?php
require 'conexion.php';

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$password=$_POST['password'];

$query="call proc_insertar_usuario('$nombre','$apellido','$telefono','$email','$password')";

$result=mysqli_query($db,$query);

if ($result) {
    header('Location:../index.php');
}


?>