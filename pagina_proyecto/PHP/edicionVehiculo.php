<?php

require('db.php');
if (
    (isset($_POST['matricula'])) &&
    (isset($_POST['chofer']) && !(empty($_POST['chofer']))) &&
    (isset($_POST['servicio']) && !(empty($_POST['servicio']))) 
) {
    $id = $_POST["matricula"];
    $chofer = $_POST["chofer"];
    $servicio = $_POST["servicio"];
    var_dump($_POST);
    

    $updateVehiculo = "UPDATE `vehiculo` SET `Servicio`='$servicio' WHERE Matricula = '$id'";
    $resultadoVehiculo = $conn->query($updateVehiculo);

    $modificar_conducen = "UPDATE `conduce` SET `Ci`='$chofer' WHERE Matricula = '$id'";
    $resultado_conducen = $conn->query($modificar_conducen);

    if (($resultado_conducen == true) && ($resultadoVehiculo == true)) { //si el insert de vehiculo y el de camion o camioneta son correctos pasan al if
        header("Location: gestion_vehiculos.php");
    } else {
        $mensaje = "No se pudo añadir el vehiculo";
        header("Location: gestion_vehiculos.php?mensaje=$mensaje");
    }
}

?>