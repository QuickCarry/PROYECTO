<?php
require('../../../db.php');
if(isset($_GET['id'])){
$id=$_GET['id'];
$sentenciadelete="DELETE FROM `pertenecen` WHERE IdPaquete = '$id'";
$listaDeletePertenecen=$conn->query($sentenciadelete);    
    
$sentenciaDELETE = "DELETE FROM `paquete` WHERE IdPaquete = '$id'";
$listaDELETE = $conn->query($sentenciaDELETE);


if ($listaDELETE && $listaDeletePertenecen){
    //echo "Paquete eliminado con éxito";
    echo '<script type="text/javascript">window.location.href = "../View/V_paquetesF.php"</script>';
    //header("Location: ../View/V_paquetesF.php");
} else {
    echo "Ocurrió un error al eliminar el paquete";
    echo "<script>alert('No se pudo eliminar');</script>";
}
}
?>
