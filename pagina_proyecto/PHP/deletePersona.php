<?php
require('db.php');

$id = $_GET['id'];
$cargo = $_GET['cargo'];

if ($cargo == "Chofer") {
    $eliminarChofer = "DELETE FROM `chofer` WHERE Ci = '$id'";
    $eliminar = "DELETE from `usuarios` WHERE id = '$id'";
    $resultadoElimnarChofer = $conn->query($eliminarChofer);
} else {
    $eliminar = "DELETE from `usuarios` WHERE id = '$id'";
}

$resultadoEliminar = $conn->query($eliminar);
if (isset($resultadoElimnarChofer)) {
    if ($resultadoEliminar && $resultadoElimnarChofer) {
        header("Location: gestion_usuarios.php");
    } else {
        echo "<script>alert('No se pudo eliminar');</script>";
    }
} else {
    if ($resultadoEliminar) {
        header("Location: gestion_usuarios.php");
    } else {
        echo "<script>alert('No se pudo eliminar');</script>";
    }
}
?>