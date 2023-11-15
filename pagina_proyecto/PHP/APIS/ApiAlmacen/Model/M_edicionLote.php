<?php
require('../../../db.php');
$jsonLote = file_get_contents('php://input');

$miArray = json_decode($jsonLote, true);
$id = $miArray['id'];
$destino = $miArray['destino'];
$estado = $miArray['estado'];
$modificacionLote="UPDATE `lote` SET `EstadoLote`='$estado',`DestinoLote`='$destino' WHERE IdLote = '$id'";

$resultadoModificar=$conn->query($modificacionLote);
    if($resultadoModificar){
        $responseDatos = array(
            "mensaje" => "Se modifico correctamente");
    }else{
        $responseDatos = array(
            "mensaje" => "No se pudo modificar");
    }
    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *');

    echo $jsonResponse = json_encode($responseDatos);
?>