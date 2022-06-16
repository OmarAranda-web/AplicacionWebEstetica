<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicio=$_POST['servicio'];
    $precio=$_POST['precio'];
    $tiempo=$_POST['tiempo'];
    $query="call proc_insertar_servicio('$servicio','$precio','$tiempo')";
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        //Redireccionamos al usuario
        header('Location: ../../verServiciosphp?resultado=1');
    }
}