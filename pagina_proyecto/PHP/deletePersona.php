<?php
require('db.php');

$id = $_GET['id'];
$eliminar="DELETE from `usuarios` WHERE id = '$id'";

$resultadoEliminar=$conn->query($eliminar);

if($resultadoEliminar){
    header("Location: gestion_usuarios.php");
}else{
    echo "<script>alert('No se pudo eliminar');</script>";
}
?>