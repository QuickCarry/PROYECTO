<?php
$jsonString = file_get_contents('php://input');

$miArray = json_decode($jsonString, true);

$idpaquete = $miArray["id"];
$destino = $miArray["destino"];
$cliente = $miArray["cliente"];
$tipo = $miArray["tipo"];
$peso = $miArray["peso"];
$lote = $miArray["lote"];
$destinoE = $miArray["Destino"	];
$ciudad = $miArray["ciudad"];
$departamento = $miArray["departamento"];

require("../../../db.php");

$buscaLote="SELECT * FROM lote WHERE DestinoLote='$departamento'";
$resultadoLote=$conn->query($buscaLote);
if(mysqli_num_rows($resultadoLote) > 0){

$sentencia = "SELECT IdPaquete FROM paquete WHERE IdPaquete = '$idpaquete'";
$lista1 = $conn->query($sentencia);

if(mysqli_num_rows($lista1) >= 1){
    $res="Ya existe este id, no se puede registrar";
    $res2 = 0;
}else{
    $fecha=date('Y-m-d H:i:s');
    $sentencia = "INSERT INTO paquete(IdPaquete, Peso, Tipo, Cliente, Departamento, FechaRegistro, Estado, DestinoExacto, Ciudad) VALUES ('$idpaquete','$peso','$tipo','$cliente','$departamento','$fecha','En lote','$destinoE','$ciudad')";
    $lista=$conn->query($sentencia);

    $sentencia2 = "INSERT INTO pertenecen(IdPaquete, IdLote) VALUES ('$idpaquete','$lote')";
    $lista2=$conn->query($sentencia2);

    if($lista == true){
        $res = "Paquete agregado con exito en paquetes";
        if($lista2 == true){
            $res2 = "Paquete agregado con exito en pertenecen";
        }else{
            $res2 = "El paquete no pudo ser ingresado en pertenecen";
        }
    }else{
        $res = "El paquete no pudo ser agregado en paquetes";
    }
}
}else{

   $res2 = "El destino del paquete no pertenece al destino del lote";
   $res="0";
}

$response=[
    "mensajePertenecen" => "$res2",
    "mensajePaquetes" => "$res"
];

    header('Content-type application/json');
    header('Access-Control-Allow-Origin: *');
    echo $jsonResponse = json_encode($response);
?>
