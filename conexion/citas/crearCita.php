<?php
//Abrir conexion al servidor SQL
require('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser=$_POST['idUsuario'];
    $alias=$_POST['alias'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $local=$_POST['local'];
    $servicios=$_POST['servicios'];

    if(! empty($servicios)){
        foreach($servicios as $servicio){
            echo "<p>$servicio</p><br>";
        }
    }else{
        echo "<p>Selecciona algo</p>";
    }

    
}


?>