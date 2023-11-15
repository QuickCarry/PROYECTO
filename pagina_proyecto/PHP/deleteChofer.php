<?php
require('db.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $eliminarChofer = "DELETE from `chofer` WHERE Ci = '$id'"; 
    $eliminarUsuario = "DELETE FROM `usuarios` WHERE id ='$id'";
    $eliminarConduce = "DELETE FROM `conduce` WHERE Ci = '$id'";
    $resultadoConduce = $conn->query($eliminarConduce);
    $resultadoEliminar=$conn->query($eliminarChofer);
    $resultadoEliminarUsuario=$conn->query($eliminarUsuario);
        if($resultadoEliminar && $resultadoEliminarUsuario && $resultadoConduce){
            header("Location: gestion_choferes.php");
        }else{
            echo "Ah ocurrido un error...";
        }
}
?>
