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
    <link rel="stylesheet" href="../STYLES/vehiculos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Agregar vehiculo</title>
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
        <h2 class="container__title">Asignar camionero a vehiculo</h2>
        <form action="asignacionCamionChofer.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label 1">Camionero:</label>
            <select name="chofer" class="container_input">
            <?php 
            require("db.php");
            $buscarChofer="SELECT chofer.* FROM chofer LEFT JOIN conduce ON chofer.Ci = conduce.Ci WHERE conduce.Ci IS NULL";
            $resultadoChofer=$conn->query($buscarChofer);
            foreach($resultadoChofer->fetch_all(MYSQLI_ASSOC) as $fila){
                $chofer=$fila["Ci"];
                $nombre=$fila["NombreCompleto"];
                echo '<option value="' . $chofer . '">' . $chofer . " | " . $nombre . '</option>';
            }
            ?>
            </select>
        </div>    
        <div class="form-row">
            <label class="container__label 2">Vehiculo:</label>
            <select name="vehiculo" class="container_input">
            <?php 
            require("db.php");
            $buscarVehiculo="SELECT vehiculo.* FROM vehiculo LEFT JOIN conduce ON vehiculo.Matricula = conduce.Matricula WHERE conduce.Matricula IS NULL";
            $resultadoVehiculo=$conn->query($buscarVehiculo);
            foreach($resultadoVehiculo->fetch_all(MYSQLI_ASSOC) as $fila2){
                $Matricula=$fila2["Matricula"];
                
                echo '<option value="' . $Matricula . '">' . $Matricula . '</option>';
            }
            ?>
            </select>
        </div>
        <div class="botones-container">
            <a href="gestion_vehiculos.php"><input type="submit" value="Registrar" class="boton 3"></a>
            <a href="gestion_vehiculos.php" class="boton 4">Volver</a>
        </div>
        </form>
    </div>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("h2").text("Assign trucker to vehicle");
                $(".1").text("Truck driver");
                $(".2").text("Vehicle");
                $(".3").val("Register");
                $(".4").text("Go Back");
                $("title").text("Add vehicle");
            })
            $(".idioma-espana").click(function(){
                $("h2").text("Asignar camionero a vehiculo");
                $(".1").text("Camionero");
                $(".2").text("Vehiculo");
                $(".3").val("Registrar");
                $(".4").text("Volver");
                $("title").text("Agregar vehiculo");
                
            })
})
        </script>
</body>
</html>

<?php

if(isset($_POST["chofer"]) && isset($_POST["vehiculo"])){
    
    $chofer = $_POST["chofer"];
    $vehiculo = $_POST["vehiculo"];

    $insertConduce="INSERT INTO conduce(Ci, Matricula, Estado) VALUE ('$chofer', '$vehiculo', 'En central')";
    $resultadoConduce=$conn->query($insertConduce);

    if($resultadoConduce == true){
	echo '<script type="text/javascript">window.location.href = "gestion_vehiculos.php"</script>';
        //header("Location: gestion_vehiculos.php");
    }else{
        $mensaje="no se pudo agregar la relacion"; 
	$urlDireccion = "gestion_vehiculos.php?mensaje=$mensaje"?>
	<script type="text/javascript">
		window.location.href = "<?php $urlDireccion?>";
	</script>
	<?php
        //header("Location: gestion_vehiculos.php?mensaje=$mensaje");
    }
}
