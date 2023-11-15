<?php
require("../../db.php");
if(isset($_GET["id"]) && isset($_GET["correo"])){
    $matricula = $_GET["id"];
    $correo = $_GET["correo"];

    $seleccionarConduce = "SELECT * FROM `conduce` WHERE Matricula = '$matricula'";
    if($seleccionarConduce == TRUE){
        $actualizacion = "UPDATE `conduce` SET `Estado`='En 2do QuickCarry' WHERE Matricula = '$matricula'";
        $resultadoActual = $conn->query($actualizacion);
        if($resultadoActual == TRUE){
            header("Location: ../View/V_Camionero.php?correo=$correo");
        }
    }
}