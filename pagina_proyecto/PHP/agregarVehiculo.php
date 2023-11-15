<?php 
session_start();
//error_reporting(0);
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
    <title>Agregar vehículo</title>
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
        <h2 class="container__title">Registrar Vehículo</h2>
       <form action="../PHP/agregarVehiculo.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label 1">Matricula:</label>
            <input name="matricula" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label 2">Servicio:</label>
            <input name="servicio" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label 3">Tipo:</label>
            <select name="tipo" class="container_input">
                <option value="Camion">Camion</option>
                <option value="Camioneta">Camioneta</option>
            </select>
            
        </div>
        <div class="botones-container">
            <a href="gestion_vehiculos.php"><input type="submit" value="Registrar" class="boton 4"></a>
            <a href="gestion_vehiculos.php" class="boton 5">Volver</a>
        </div>
        </form>
    </div>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("h2").text("Register vehicle");
                $(".1").text("License plate");
                $(".2").text("Service");
                $(".3").text("Type");
                $(".4").val("Register");
                $(".5").text("Go Back");
                $("title").text("Add vehicle");
            })
            $(".idioma-espana").click(function(){
                $("h2").text("Registrar vehículo");
                $(".1").text("Matricula");
                $(".2").text("Servicio");
                $(".3").text("Tipo");
                $(".4").val("Registrar");
                $(".5").text("Volver");
                $("title").text("Agregar vehiculo");
                
            })
})
        </script>
</body>
</html>

<?php
    require('db.php');
    if((isset($_POST['matricula']) && !(empty($_POST['matricula']))) && 
    (isset($_POST['servicio']) && !(empty($_POST['servicio']))) && 
    (isset($_POST['tipo']) && !(empty($_POST['tipo'])))){
    $id = $_POST["matricula"];
    $servicio = $_POST["servicio"];
    $tipo = $_POST["tipo"];
    //$estado = "Fuera de servicio"; //variable "fuera de servicio" para cuando se ingresa un camionero que conduce un camion
    if($tipo == "Camion"){
        $agregar_vehiculo = "INSERT INTO vehiculo(Matricula, Servicio) VALUES ('$id', '$servicio')";
        $resultado_vehiculo = $conn->query($agregar_vehiculo);  //agrega el camion en vehiculo
        $agregar_camion = "INSERT INTO camion(Matricula) VALUES ('$id')";
        $resultado_alta_camion = $conn->query($agregar_camion); //agrega la camioneta en camioneta
    }elseif($tipo == "Camioneta"){
        $agregar_vehiculo = "INSERT INTO vehiculo(Matricula, Servicio) VALUES ('$id', '$servicio')";
        $resultado_vehiculo = $conn->query($agregar_vehiculo); //agrega la camioneta en vehiculo
        $agregar_camioneta = "INSERT INTO camioneta(Matricula) VALUES ('$id')";
        $resultado_alta_camioneta = $conn->query($agregar_camioneta); //agrega la camioneta en camioneta
    }
    
    if(($resultado_vehiculo == true) && ($resultado_alta_camion == true || $resultado_alta_camioneta == true)){  //si el insert de vehiculo y el de camion o camioneta son correctos pasan al if
        echo '<script type="text/javascript">window.location.href = "gestion_vehiculos.php"</script>'; 
	//header("Location: gestion_vehiculos.php");
        }else{
            $mensaje="No se pudo añadir el vehiculo";
	    $urlDireccion="gestion_vehiculos.php?mensaje=$mensaje";?>
	    <script type="text/javascript"> window.location.href = "<?php $urlDireccion?>" </script>
	    <?php
            //header("Location: gestion_vehiculos.php?mensaje=$mensaje");
        }
}

?>
