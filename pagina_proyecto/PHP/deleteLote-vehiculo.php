<?php

if(isset($_GET["id"])){
    require("db.php");
    $lote = $_GET["id"];
    $sentencia = "DELETE FROM `transporta` WHERE IdLote = '$lote'";
    $resSentencia = $conn->query($sentencia);

    if($resSentencia == TRUE){
        header("Location: asignacionLote-Vehiculo.php");
    }
}