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

    //Registrar una cita
   $query="call proc_insertar_cita('$alias','$fecha','$hora','$idUser','$local')";
   $resultCita=mysqli_query($db,$query);

    $queryIdCita="select MAX(id_cita) FROM cita WHERE idUsuarios='$idUser'";
    $resultIdCita=mysqli_query($db,$queryIdCita);
    $idCita=mysqli_fetch_row($resultIdCita);
    $idCita=$idCita[0];
   
    if(! empty($servicios)){
        foreach($servicios as $servicio){
            $queryDetalle="call proc_insertar_detCita('$idCita', '$servicio')";
            $resultDetalle=mysqli_query($db,$queryDetalle);
            if (!$resultDetalle) {
                $error=mysqli_error($db);
                echo "<h2>Error: $error</h2>";
            }
        }
    }else{
        echo "<p>Selecciona algo</p>";
    }

}


?>