<?php

$jsonString = file_get_contents('php://input');

$miArray = json_decode($jsonString, true);

$matricula = $miArray["matricula"];
$idPaquete = $miArray["paquete"];

require("../../../db.php");

$sentencia = "INSERT INTO vahacia(Matricula, IdPaquete, FechaEntrega) VALUES ('$matricula','$idPaquete','')";
$resultadosentencia = $conn->query($sentencia);

$modPaquete = "UPDATE `paquete` SET `Estado`='En camioneta' WHERE IdPaquete = '$idPaquete'";
$resultadoMod = $conn->query($modPaquete);

if(($resultadosentencia == true) && ($resultadoMod == true)){
        $mens="Funciono correctamente";
}else{
    $mens= "No funciono correctamente";
}

$resultado = array( 
    "mensaje" => $mens
);

header('Content-type application/json');
header('Access-Control-Allow-Origin: *');

echo $jsonResponse = json_encode($resultado);

