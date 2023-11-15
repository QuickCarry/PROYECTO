<?php
require('../../../db.php');
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $buscaPertenece = "SELECT * FROM `pertenecen` WHERE IdLote = '$id'";
    $resultadoPertenece = $conn->query($buscaPertenece);
    if (mysqli_num_rows($resultadoPertenece) == 0) {
        $sentenciaDELETE = "DELETE FROM `lote` WHERE IdLote = '$id'";
        $listaDELETE = $conn->query($sentenciaDELETE);
        if ($listaDELETE) {
            echo "Lote eliminado con éxito";
	    echo '<script type="text/javascript">window.location.href = "../View/V_Lote.php"</script>';
            //header("Location: ../View/V_Lote.php");
        } else {
            echo "Ocurrió un error al eliminar el lote";
            echo "<script>alert('No se pudo eliminar');</script>";
        }
    }else{
        $mensaje="No se puede borrar este lote porque contien paquetes";
        header("Location: ../View/V_Lote.php?mensaje=$mensaje");
    }
}
?>
