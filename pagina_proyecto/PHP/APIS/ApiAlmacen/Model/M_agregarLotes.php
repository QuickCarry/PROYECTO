<?php
require('../../../db.php');
$jsonLote = file_get_contents('php://input');

$miArray = json_decode($jsonLote, true);
$destino = $miArray['destino'];
$fecha = $miArray['fecha'];

$buscarAlmacen = "SELECT * FROM `almacencarry` WHERE Departamento = '$destino'";
$resultadoBuscar = $conn->query($buscarAlmacen);

if (mysqli_num_rows($resultadoBuscar) > 0) {
    $AgregarLote = "INSERT INTO lote(EstadoLote, DestinoLote, FechaEstimada) VALUES ('En Central','$destino', '$fecha')";
    $resultadoAgregar = $conn->query($AgregarLote);
    if ($resultadoAgregar) {
        $responseDatos = array(
            "mensaje" => "Se agrego correctamente"
        );
    } else {
        $responseDatos = array(
            "mensaje" => "No se pudo agregar"
        );
    }
} else {
    $responseDatos = array(
        "mensaje" => "No existe el almacen"
    );
}

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
$jsonResponse = json_encode($responseDatos);

echo $jsonResponse;
?>
