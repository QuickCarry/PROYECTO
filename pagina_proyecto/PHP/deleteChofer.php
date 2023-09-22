<?php
require('db.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $eliminarChofer = "DELETE from `chofer` WHERE Ci = '$id'"; 
    $eliminarUsuario = "DELETE FROM `usuarios` WHERE id ='$id'";
    $resultadoEliminar=$conn->query($eliminarChofer);
    $resultadoEliminarUsuario=$conn->query($eliminarUsuario);
        if($resultadoEliminar && $resultadoEliminarUsuario){
            header("Location: gestion_choferes.php");
        }else{
            echo "Ah ocurrido un error...";
        }
}
?>
