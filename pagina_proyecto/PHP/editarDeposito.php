<?php
require ('db.php');
if(isset($_POST['idcarry']) && isset($_POST['departamento']) && isset($_POST['ruta'])){
    $id = $_POST["idcarry"];
    $departamento = $_POST["departamento"];
    $ruta = $_POST["ruta"];

    $modificacion="UPDATE `almacencarry` SET `Departamento`='$departamento',`Ruta`='$ruta' WHERE IDCarry = '$id'";
    $resultadoModificar=$conn->query($modificacion);
    if($resultadoModificar){
        //header("Location: gestion_depositos.php");
        echo '<script type="text/javascript">window.location.href = "gestion_depositos.php"</script>';
    }else{
        echo "<script>alert('No se pudo modificar');</script>";
    }
}

