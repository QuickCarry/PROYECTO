<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Productos</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>

    <div class="container-add">
        
        <h2 class="container__title">Registrar paquete</h2>
            <form action="../PHP/agregarPaqueteA.php" method="post" class="container__form">
            <div class="form-row">
                <label class="container__label">Nombre del cliente</label>
                <input name="cliente" type="text" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label">Destino</label>
                <input name="destino" type="text" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label">Peso</label>
                <input name="peso" type="text" class="container_input"></input>
            </div>  
            <div class="form-row">
                <label class="container__label">Tipo</label>
                <input name="tipo" type="text" class="container_input"></input>
            </div>  
            <div class="form-row">
                <label class="container__label">Fecha</label>
                <input name="fecha" type="text" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label">Lote Asignado</label>
                <input name="lote" type="text" class="container_input"></input>
            </div>
            <!-- <div class="form-row">
                <label class="container__label">Hora de envio</label>
                <input name="hora" type="text" class="container_input"></input>
            </div>     -->
            <div class="form-row">
                <label for="container__label">Estado</label>
                <select name="estado" class="container_input">
                    <option value="En preparacion">En preparacion</option>
                    <option value="En camino">En camino</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>
                <a href="gestion_paquetes.php" class="registrar"><input type="submit" value="Registrar" class="container__submit"></a>
            </form>
        </div>
</body>
</html>
<?php
if(isset($_POST['cliente']) && isset($_POST['destino']) && isset($_POST['peso']) && isset($_POST['tipo']) && isset($_POST['fecha']) && isset($_POST['lote']) && isset($_POST['estado'])){
    
    require('../PHP/apiAlmacen.php');
    $paquete=new paquete();
    $paquete->post($_POST['destino'], $_POST['cliente'], $_POST['fecha'], $_POST['lote'], $_POST['peso'], $_POST['tipo'], $_POST['estado']);
        
    header("Location: gestion_paquetes.php");
    echo "<script> function confirmacionPaquete(event){
        if (confirm('No existe dicho almacen. ¿Quiere intentar de nuevo?')){
        return true;
        }else{
        event.preventDefault();
        }
        }</script>";
}
?>