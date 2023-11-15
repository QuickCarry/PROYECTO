<?php
$jsonString = file_get_contents('php://input');

$miArray = json_decode($jsonString, true);

$idpaquete = $miArray["id"];
$destino = $miArray["destino"];
$cliente = $miArray["cliente"];
$fecha = $miArray["fecha"];
$tipo = $miArray["tipo"];
$peso = $miArray["peso"];
$lote = $miArray["lote"];
$departamento = $miArray["departamento"];
$ciudad = $miArray["ciudad"];

require("../../../db.php");
$sentencia = "INSERT INTO paquete(IdPaquete, Peso, Tipo, Cliente, DestinoExacto, FechaRegistro, Estado, Departamento, Ciudad) VALUES ('$idpaquete','$peso','$tipo','$cliente','$destino','$fecha','En lote', '$departamento', '$ciudad')";
$lista=$conn->query($sentencia);

$sentencia2 = "INSERT INTO pertenecen(IdPaquete, IdLote) VALUES ('$idpaquete','$lote')";
$lista2=$conn->query($sentencia2);

if($lista && $lista2){
    $response=array(
    "mensaje" => "Funciono correctamente"
    );
}elseif(($lista == true) && ($lista2 == false)){
    $response=array(
    "mensaje" => "No funciono correctamente"
    );
}elseif(($lista == false) && ($lista2 == true)){
    $response=array(
    "mensaje" => "No funciono correctamente"
    );
}else{
    $response=array(
    "mensaje" => "algo salio mal"
    );
}
    header('Content-type application/json');
    header('Access-Control-Allow-Origin: *');

    $jsonResponse = json_encode($response);
    echo $jsonResponse;
?>
