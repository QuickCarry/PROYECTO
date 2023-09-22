<?php
require('db.php');
if(isset($_GET['id'])){
$id=$_GET['id'];
$sentenciaDELETE = "DELETE FROM `paquete` WHERE idPaquete = '$id'";
$listaDELETE = $conn->query($sentenciaDELETE);

if ($listaDELETE){
    echo "Paquete eliminado con éxito";
    header("Location: ver_paquetesF.php");
} else {
    echo "Ocurrió un error al eliminar el paquete";
    echo "<script>alert('No se pudo eliminar');</script>";
}
}
?>