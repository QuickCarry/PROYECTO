<?php 
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: ../../../inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../STYLES/lote.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Creacion de lotes</title>
</head>

<body>
<header>
        <div class="logo">
            <a href="#"> <img src="../../../../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
        <nav class="menu">
            <a href="#"><img src="../../../../IMAGES/espana.png" alt="" class="idioma-espana"></a>
            <a href="#"><img src="../../../../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
        </nav>
    </header>
    

    <div class="container-add">
        <h2 class="container__title">Creación de lote</h2>
        <form action="../Controller/C_agregarLotes.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label 1">Destino</label>
            <select name="destino" class="container_input">
                <option value="Montevideo">Montevideo</option>
                <option value="Canelones">Canelones</option>
                <option value="San Jose">San Jose</option>
                <option value="Maldonado">Maldonado</option>
                <option value="Rocha">Rocha</option>
                <option value="Colonia">Colonia</option>
                <option value="Lavalleja">Lavalleja</option>
                <option value="Florida">Florida</option>
                <option value="Flores">Flores</option>
                <option value="Soriano">Soriano</option>
                <option value="Durazno">Durazno</option>
                <option value="Treinta y Tres">Treinta y Tres</option>
                <option value="Rio Negro">Rio Negro</option>
                <option value="Cerro Largo">Cerro Largo</option>
                <option value="Tacuarembó">Tacuarembó</option>
                <option value="Paysandú">Paysandú</option>
                <option value="Rivera">Rivera</option>
                <option value="Salto">Salto</option>
                <option value="Artigas">Artigas</option>
            </select>
        </div>
        <div class="form-row">
            <label class="container__label 2">Fecha estimada</label>
            <!-- <input type="text" name="FEstimada" class="container_input" placeholder="aaaa-mm-dd"> -->
            <input type="date" name="FEstimada" class="container_input">
        </div>
            <div class="botones-container">
                <a href="../../../../HTML/funcionario.php" class="3"><input type="submit" value="Registrar" class="boton 3"></a>
                <a href="../../../../HTML/funcionario.php" class="boton 4">Volver</a>
            </div>
        </form>
    </div>
    <script>
    $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $("title").text("Batch creation");
                    $("h2").text("Batch creation");
                    $(".1").text("Destination");
                    $(".2").text("Estimated date");
                    $(".3").val("Register");
                    $(".4").text("Go Back");
                })
                $(".idioma-espana").click(function(){
                    $("title").text("Creación de lotes");
                    $("h2").text("Creación de lote");
                    $(".1").text("Destino");
                    $(".2").text("Fecha estimada");
                    $(".3").val("Registrar");
                    $(".4").text("Volver");
                })
            })
        </script>
    
    
</body>

</html>

<?php

if(isset($_GET["mensaje"])){
    ?><h1><?php echo $_GET["mensaje"] ?></h1><?php
}
