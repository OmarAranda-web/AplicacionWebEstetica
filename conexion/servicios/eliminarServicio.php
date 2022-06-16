<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id=$_GET['id'];
    $query="update servicio set servicio.estatus=0 where id_servicio='$id'";
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        //Redireccionamos al usuario
        header('Location: ../../verservicios.php');
    }
}