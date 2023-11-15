<?php 
session_start();
//error_reporting(0);
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

    <div class="container-add">
        
        <h2 class="container__title">Registrar Paquete</h2>
            <form action="../Controller/C_agregarPaqueteA.php" method="post" class="container__form">
            <div class="form-row">
                <label class="container__label 1">Id Paquete</label>
                <input name="id" type="number" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label 2">Nombre del cliente</label>
                <input name="cliente" type="text" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label 3">Departamento</label>
                <input name="departamento" type="text" class="container_input"></input>
            </div>
	    <div class="form-row">
		<label class="container_label">Ciudad</label>
		<input name="ciudad" type="text" class="container_input"></input>
	    </div>
	    <div class="form-row">
		<label class="container_label 3">Destino</label>
		<input name="destino" type="text" class="container_input"></input>
	    </div>
            <div class="form-row">
                <label class="container__label 4">Peso</label>
                <input name="peso" type="text" class="container_input"></input>
            </div>  
            <div class="form-row">
                <label class="container__label 5">Tipo</label>
                <select name="tipo" class="container_input">
                    <option value="Frágil 6">Frágil</option>
                    <option value="Peligroso 7">Peligroso</option>
                    <option value="Inflamable 8">Inflamable</option>
                </select>
            </div>  
            <div class="form-row">
                <label class="container__label 9">Fecha</label>
                <input name="fecha" type="date" class="container_input"></input>
            </div>
            <div class="form-row">
                <label class="container__label 10">Lote Asignado</label>
                <select name="lote" class="container_input">
                <?php 
                require('../../../db.php');
                $sentencia = "SELECT * FROM `lote`"; //toma todos los paquetes de la tabla lote
                $filas = $conn->query($sentencia); //hace la consulta de los lotes
                foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada lote
                   
                    echo '<option value="'.$fila['IdLote'] .'">'.$fila['IdLote']."|".$fila["DestinoLote"].'</option>';
                }
                   ?>
                 </select>
                
            </div>
            <div class="botones-container">
                <a href="V_gestion_paquetes.php" class="registrar"><input type="submit" value="Registrar" class="boton 11"></a>
                <a href="V_gestion_paquetes.php" class="boton 12">Volver</a>
            </div>
                <!-- Falta agrergar css para el boton de volver -->
            </form>
        </div>
        <script>
            $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $("Title").text("Packages");
                    $("h2").text("Register Package");
                    $(".1").text("Id Package");
                    $(".2").text("Customer name");
                    $(".3").text("Destination");
                    $(".4").text("Weight");
                    $(".5").text("Type");
                    $(".6").text("Fragile");
                    $(".7").text("Dangerous");
                    $(".8").text("Flammable");
                    $(".9").text("Date");
                    $(".10").text("Assigned lot");
                    $(".11").val("Register");
                    $(".12").text("Go Back");
                    $("select[name='tipo'] option[value='Frágil 6']").text("Fragile");
                    $("select[name='tipo'] option[value='Peligroso 7']").text("Dangerous");
                    $("select[name='tipo'] option[value='Inflamable 8']").text("Flammable");
                    
                })
                $(".idioma-espana").click(function(){
                    $("Title").text("Paquetes");
                    $("h2").text("Registrar Paquete");
                    $(".1").text("Id del paquete");
                    $(".2").text("Nombre del cliente");
                    $(".3").text("Destino");
                    $(".4").text("Peso");
                    $(".5").text("Tipo");
                    $(".6").val("Frágil");
                    $(".7").text("Peligroso");
                    $(".8").text("Inflamable");
                    $(".9").text("Fecha");
                    $(".10").text("Lote Asignado");
                    $(".11").val("Registrar");
                    $(".12").text("Volver");
                    $("select[name='tipo'] option[value='Frágil 6']").text("Frágil");
                    $("select[name='tipo'] option[value='Peligroso 7']").text("Peligroso");
                    $("select[name='tipo'] option[value='Inflamable 8']").text("Inflamable");
                })
            })
        </script>
</body>
<?php
if(isset($_GET["mensaje"])){?>
  <h2><?php echo $_GET["mensaje"]; ?> </h2>
<?php
}
