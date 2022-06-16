<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $query="call proc_insertar_local('$nombre','$direccion')";
     
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        //Redireccionamos al usuario
        header('Location: ../../verLocales.php');
    }
}