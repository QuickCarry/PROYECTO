<?php 
session_start();
// error_reporting(0);
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
    <link rel="stylesheet" href="../STYLES/vehiculos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Lote a vehículo</title>
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

    <div class="container-add">
        <h2 class="container__title">Asignar un lote a un vehículo</h2>
        <form action="../PHP/asignarLoteCamion.php" method="post" class="container__form">
        <div class="form-row">  
                <label class="container__label 1">Matrícula</label>
                <select name="matricula" class="container_input">
                <?php 
                require('db.php');
                $sentencia = "SELECT * FROM `vehiculo`"; //toma todos los paquetes de la tabla lote
                $filas = $conn->query($sentencia); //hace la consulta de los lotes
                foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada lote
                    echo '<option value="'.$fila['Matricula'].'">'.$fila['Matricula'].'</option>';
                }
                   ?>
                 </select>
            </div>    
        <div class="form-row">
            <label class="container__label 2">Lotes</label>
            <select name="lote" class="container_input">
                <?php 
                require('db.php');
                $sentencia = "SELECT * FROM `lote`"; //toma todos los lotes de la tabla lote
                $filas = $conn->query($sentencia); //hace la consulta de los lotes
                foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada lote
                    echo '<option value="'.$fila['IdLote'].'">'.$fila['IdLote']."|".$fila['DestinoLote'].'</option>';
                }
                   ?>
                 </select>
        </div>
        <!-- <div class="form-row">
            <label class="container__label">Fecha de salida</label>
            <input type="text" placeholder="dd/mm" class="container_input" name="fecha">
        </div> -->
        <div class="botones-container">
            <a href="asignacionLote-Vehiculo.php"><input type="submit" value="Asignar" class="boton 3"></a>
            <a href="asignacionLote-Vehiculo.php" class="boton 4">Volver</a>
        </div>
        </form>
    </div>
    <script>
            $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $("title").text("Lot to vehicle");
                    $("h2").text("Assign a lot to a vehicle");
                    $(".1").text("License plate");
                    $(".2").text("Lots");
                    $(".3").val("Assign");
                    $(".4").text("Go Back");
                })
                $(".idioma-espana").click(function(){
                    $("title").text("Lote a vehículo");
                    $("h2").text("Asignar un lote a un vehículo");
                    $(".1").text("Matrícula");
                    $(".2").text("Lotes");
                    $(".3").text("Asignar");
                    $(".4").val("Volver");
    
                })
            })
        </script>
</body>
</html>


<?php
require('db.php');
if(isset($_POST['matricula']) && isset($_POST['lote'])){
$matricula=$_POST['matricula'];
$lote=$_POST['lote'];

$fecha=date('Y-m-d H:i:s');
$insert_transporta = "INSERT INTO transporta(IdLote, Matricula, FechaEntrega) VALUES ('$lote', '$matricula', '$fecha')";
$resultado_transporta = $conn->query($insert_transporta);

$estado="En Camion";
$update_lote = "UPDATE `lote` SET `EstadoLote`='$estado' WHERE IdLote = '$lote'";
$resultado_transporta = $conn->query($update_lote);
if($resultado_transporta && $resultado_transporta){
    echo '<script type="text/javascript">window.location.href = "asignacionLote-Vehiculo.php"</script>';
    //header("Location: asignacionLote-Vehiculo.php");
}else{
    $mensaje="Algo salio mal";
    header("Location: asignacionLote-Vehiculo.php?mensaje=$mensaje");
}

}
?>
