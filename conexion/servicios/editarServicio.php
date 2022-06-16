<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id=$_POST['id'];
    $servicio=$_POST['servicio'];
    $precio=$_POST['precio'];
    $tiempo=$_POST['tiempo'];
    $query="call proc_editar_servicio('$id','$servicio','$precio','$tiempo')";
    
    
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        //Redireccionamos al usuario
        header('Location: ../../verservicios.php');
    }
}