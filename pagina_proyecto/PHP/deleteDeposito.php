<?php
require('db.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $eliminar="DELETE from `almacencarry` WHERE IDCarry = '$id'";
    $resultadoEliminar=$conn->query($eliminar);

        if($resultadoEliminar){
            header("Location: gestion_depositos.php");
        }else{
            echo "<script>alert('No se pudo eliminar'); </script>";
        }
}
?>
