<?php
require("../../../db.php");
$jsonString = file_get_contents('php://input');

$miArray = json_decode($jsonString, true);

$id=$miArray["id"];
$destino = $miArray["destino"];
$cliente = $miArray["cliente"];
$fecha = $miArray["fecha"];
$tipo = $miArray["tipo"];
$peso = $miArray["peso"];
$estado = $miArray["estado"];
$lote = $miArray ["lote"];
$sentenciaPUT="UPDATE `paquete` SET `Ubicacion`='$destino', `Cliente`='$cliente', `FechaRegistro`='$fecha', `Tipo`='$tipo', `Peso`='$peso'  WHERE `IdPaquete` = '$id'";
$listaPUT=$conn->query($sentenciaPUT);
$sentenciaPUTlote = "UPDATE `pertenecen` SET `IdLote` = '$lote' WHERE `IdPaquete` = '$id'";
$listaPUTlote=$conn->query($sentenciaPUTlote); 
    if($listaPUT && $listaPUTlote){
        $responseDatos = array(
            "mensaje" => "Funciono correctamente"
        );
    }else{
        $responseDatos = array(
            "mensaje" => "No se pudo modificar"
        );
    }

    header('Content-type application/json');
    header('Access-Control-Allow-Origin: *');

    echo $jsonResponse = json_encode($responseDatos);

?>