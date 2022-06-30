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
    $cita=$_POST['idCita'];
    //Registrar una cita
   $query="call editar_cita('$cita','$alias','$fecha','$hora','$local')";
   $resultCita=mysqli_query($db,$query);


    mysqli_close($db);
    require('../conexion.php');
   
    if(! empty($servicios)){
        foreach($servicios as $servicio){
            $queryDetalle="call proc_insertar_detCita('$cita', '$servicio')";
            $resultDetalle=mysqli_query($db,$queryDetalle);
            if (!$resultDetalle) {
                $error=mysqli_error($db);
                echo "<h2>eroor:$error</h2>";
            }
        }

        header("Location: ../../inicioUser.php");
    }

    //pdf

}


?>