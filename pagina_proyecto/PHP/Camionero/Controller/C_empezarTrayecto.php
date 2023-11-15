<?php
require("../../db.php");
if (isset($_GET["id"]) && isset($_GET["correo"])) {
    $matricula = $_GET["id"];
    $correo = $_GET["correo"];

    $sentenciaBuscarVehiculo = "SELECT * FROM `conduce` WHERE matricula = '$matricula'";
    $resultado1 = $conn->query($sentenciaBuscarVehiculo);
    if (mysqli_num_rows($resultado1) > 0) {
        $sentenciaInsertConduce = "UPDATE `conduce` SET `Estado`='En rumbo' WHERE Matricula = '$matricula'";
        $resultado2 = $conn->query($sentenciaInsertConduce);
        if ($resultado2 == true) {
            header("Location: ../View/V_Camionero.php?correo=$correo");
        } else {
            $mensaje = "Algo salio mal";
            header("Location: ../View/V_Camionero.php?mensaje=$mensaje&correo=$correo");
        }
    }
}