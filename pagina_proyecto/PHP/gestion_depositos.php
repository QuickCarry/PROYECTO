<?php 
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/depositos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Depositos</title>
</head>
<body>
<header>
    <div class="logo">
        <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
    </div>
    <nav class="menu">
        <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma-espana"></a>
        <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
    </nav>
</header>
    <h1>Gestion de depositos</h1>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id</div>
            <div class="table-cell H 2">Departamento</div>
            <div class="table-cell H 3">Ruta</div>
            <div class="table-cell H 4">Editar o eliminar</div>
    <?php
    require('db.php');
    $sentencia="SELECT * from `almacencarry`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <div class="table-cell V 1">Id</div>
            <div class="table-cell"><?php echo $fila['IDCarry'];?></div>
            <div class="table-cell V 2">Departamento</div>
            <div class="table-cell"><?php echo $fila['Departamento']; ?></div>
            <div class="table-cell V 3">Ruta</div>
            <div class="table-cell"><?php echo $fila['Ruta'];?></div>
            <div class="table-cell V 4">Editar o Eliminar</div>
            <div class="table-cell">
                <a href="edicionDeposito.php?id=<?php echo $fila["IDCarry"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                <a href="deleteDeposito.php?id=<?php echo $fila["IDCarry"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
            </div>
        <?php
    }
?>  
        </div>
    </div> 
    <div class="botones-container">
        <a href="agregarDeposito.php" class="boton 5">Agregar</a>
        <a href="../HTML/admin.php" class="boton 6">Volver</a>
    </div>
<script src="../JS/confirmacionDeposito.js"></script>
<script>
$(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Deposits");
                $("h1").text("Deposit management");
                $(".1").text("Id");
                $(".2").text("Departament");
                $(".3").text("Route");
                $(".4").text("Edit or Delete");
                $(".5").val("Add");
                $(".6").val("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Depositos");
                $("h1").text("Gestión de depositos");
                $(".1").text("Id");
                $(".2").text("Depàrtamento");
                $(".3").text("Ruta");
                $(".4").text("Editar o Eliminar");
                $(".5").val("Agregar");
                $(".6").val("Volver");
            })
})
        </script>
</body>
</html>
