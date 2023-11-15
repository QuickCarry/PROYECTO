<?php 
var_dump($_GET);
require("../../db.php");
$id = $_GET["id"];
$correo = $_GET["correo"];
$sentencia_estado = "UPDATE `paquete` SET `Estado`='Entregado' WHERE IdPaquete = '$id'";
$resultado =$conn->query($sentencia_estado);

if($resultado){
    header("Location: ../View/V_Camionero.php?correo=$correo");
}

?>