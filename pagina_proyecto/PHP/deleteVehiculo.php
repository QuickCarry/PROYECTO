<?php 
require("db.php");
if (isset($_GET["id"])){

$matricula = $_GET["id"];

$seleccionVehiculo = "SELECT * FROM `vehiculo` WHERE Matricula = '$matricula'";
$resultSeleccion = $conn->query($seleccionVehiculo);

$seleccionCamion = "SELECT * FROM `camion` WHERE Matricula = '$matricula'";
$resultSeleccioncamion = $conn->query($seleccionCamion);

$seleccionCamioneta = "SELECT * FROM `camioneta` WHERE Matricula = '$matricula'";
$resultSeleccioncamioneta = $conn->query($seleccionCamioneta);

if((mysqli_num_rows($resultSeleccion) > 0) && (mysqli_num_rows($resultSeleccioncamion) > 0)){
    $deleteCamion = "DELETE FROM `camion` WHERE Matricula = '$matricula'";
    $resultDeletCamion = $conn->query($deleteCamion);
}elseif((mysqli_num_rows($resultSeleccion) > 0) && (mysqli_num_rows($resultSeleccioncamioneta) > 0)){
    $deleteCamioneta = "DELETE FROM `camioneta` WHERE Matricula = '$matricula'";
    $resultDeletCamioneta = $conn->query($deleteCamioneta);
}
}

$deleteTransporta = "DELETE FROM `transporta` WHERE Matricula = '$matricula'";
$resultDeletTransporta = $conn->query($deleteTransporta);


$seleccionConduce = "SELECT * FROM `conduce` WHERE Matricula = '$matricula'";
$resultConduce = $conn->query($seleccionConduce);

foreach($resultConduce->fetch_all(MYSQLI_ASSOC) as $fila1){
    $chofer = $fila1["Ci"];
}

$deleteConduce = "DELETE FROM conduce WHERE `conduce`.`Ci` = '$chofer' AND `conduce`.`Matricula` = '$matricula'";
$resultConduce = $conn->query($deleteConduce);

$deleteVehiculo = "DELETE FROM `vehiculo` WHERE Matricula = '$matricula'";
$resultDeleteVehiculo = $conn->query($deleteVehiculo);
if(($resultDeletCamion || $resultDeletCamioneta) && $resultDeleteVehiculo && $resultConduce && $resultDeletTransporta){
    header("Location: gestion_vehiculos.php");
}
?>
