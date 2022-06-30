<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id=$_GET['id'];
    $query="call proc_cancelar_cita('$id')";
    $resultado = mysqli_query($db, $query);

    //Redireccionamos al usuario
    session_start();
    $auth = $_SESSION['admin'];

    if ($resultado) {

        if ($auth) {
            header('Location: ../../inicio.php');
        }else{
            header('Location: ../../inicioUser.php');
        }
    }
}