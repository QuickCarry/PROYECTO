<?php 
require("../../../db.php");
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $deletePaqueteCamioneta= "DELETE FROM `vahacia` WHERE IdPaquete = '$id'";
    $resultadoDelete =  $conn->query($deletePaqueteCamioneta);
    if($resultadoDelete == true){
    header("Location: ../View/V_agregarPaqueteCamioneta.php");
    }else{
        $mensaje = "algo salio mal";
        header("Location: ../View/V_agregarPaqueteCamioneta.php?mensaje=$mensaje");
    }
}