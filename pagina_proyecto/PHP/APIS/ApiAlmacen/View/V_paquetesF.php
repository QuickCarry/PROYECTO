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
    <link rel="stylesheet" href="../../../../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paquetes</title>
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
    <div class="table-container">
        <div class="table-header">
        <div class="table-cell H 1">IdLote</div>
        <div class="table-cell H 2">IdPaquete</div>
        <div class="table-cell H 3">Peso</div>
        <div class="table-cell H 4">Tipo</div>
        <div class="table-cell H 5">Cliente</div>
        <div class="table-cell H 6">Ubicacion</div>
        <div class="table-cell H 7">Fecha de Registro</div>
        <div class="table-cell H 8">Estado</div>
        <div class="table-cell H 9">Editar o Eliminar</div>
    <?php
    require('../../../db.php');
    $sentencia = "SELECT * from `paquete`";
    $filas = $conn->query($sentencia);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { 
        $id=$fila['IdPaquete'];
        $sentencialote = "SELECT * FROM `pertenecen` WHERE IdPaquete = '$id'";
        $filas2 = $conn->query($sentencialote);
        ?>
            <div class="table-cell V 1">IdLote</div>
            <div class="table-cell"><?php 
                    if(mysqli_num_rows($filas2) > 0){
                        foreach($filas2->fetch_all(MYSQLI_ASSOC) as $fila2){
                            echo $fila2["IdLote"];
                        }
                    }else {
                        echo "-";
                    } 
                    ?></div>
                <div class="table-cell V 2">IdPaquete</div>
                <div class="table-cell"><?php echo $fila['IdPaquete']; ?></div>
                <div class="table-cell V 3">Peso</div>
                <div class="table-cell"><?php echo $fila['Peso']; ?></div>
                <div class="table-cell V 4">Tipo</div>
                <div class="table-cell"><?php echo $fila['Tipo']; ?></div>
                <div class="table-cell V 5">Cliente</div>
                <div class="table-cell"><?php echo $fila['Cliente']; ?></div>
                <div class="table-cell V 6">Ubicacion</div>
                <div class="table-cell"><?php echo $fila['DestinoExacto']; ?></div>
                <div class="table-cell V 7">Fecha de Registro</div>
                <div class="table-cell"><?php echo $fila['FechaRegistro'];?></div>
                <div class="table-cell V 8">Estado</div>
                <div class="table-cell"><?php echo $fila['Estado'];?></div>
                <div class="table-cell V 9">Editar o eliminar</div>
                <div class="table-cell">
                    <a href="../View/V_edicionPaqueteF.php?id=<?php echo $fila["IdPaquete"];?>"><img src="../../../../IMAGES/editar.svg" alt="" class="edit"></a> 
                    <a href="../Model/M_deletePaqueteF.php?id=<?php echo $fila["IdPaquete"];?>" class="item_delete"><img src="../../../../IMAGES/equis.svg" class="x"></a>
                </div>
    <?php
    };
?>
    </div>
    </div>
    <div class="botones-container">
        <a href="../../../../HTML/funcionario.php" class="boton 10">Volver</a>
    </div>
    <script src="../../../../JS/confirmacionPaquete.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Packages");
                $(".1").text("Id Lot");
                $(".2").text("Id Package");
                $(".3").text("Wegiht");
                $(".4").val("Type");
                $(".5").text("Client");
                $(".6").text("Location");
                $(".7").text("Registration Date");
                $(".8").text("Status");
                $(".9").text("Edit or delete");
                $(".10").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Paquetes");
                $(".1").text("IdLote");
                $(".2").text("IdPaquete");
                $(".3").text("Peso");
                $(".4").val("Tipo");
                $(".5").text("Cliente");
                $(".6").text("Ubicacion");
                $(".7").text("Fecha de Registro");
                $(".8").text("Estado");
                $(".9").text("Editar o eliminar");
                $(".10").text("Volver");
            })
})
        </script>
</body>

</html>
<?php
if(isset($_GET["mensaje"])){?>
    <h1 class="p_error1"><?php echo $response;?></h1>
                    <!-- Falta css para este error -->
                   <?php
}
