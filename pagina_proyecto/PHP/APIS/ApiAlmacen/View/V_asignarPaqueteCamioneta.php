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
    <link rel="stylesheet" href="../../../../STYLES/depositos.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paquete a camioneta</title>
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
        <h2 class="container__title">Asignar un paquete a una camioneta</h2>
        <form action="../Controller/C_asignacionPaquete-Camioneta.php" method="post" class="container__form">
            <div class="form-row">
                <label class="container__label 1">Matricula</label>
                <select name="matricula" class="container_input">
                    <?php
                    require('../../../db.php');
                    $sentencia = "SELECT * FROM `vehiculo`"; //toma todos los vehiculos
                    $filas = $conn->query($sentencia); //hace la consulta de los vehiculos
                    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada lote
                        $matricula = $fila["Matricula"];
                        $sentenciaCamioneta = "SELECT * FROM `camioneta` WHERE Matricula = '$matricula'";
                        $resultadoCamioneta = $conn->query($sentenciaCamioneta);
                        foreach ($resultadoCamioneta->fetch_all(MYSQLI_ASSOC) as $registroCamioneta) {
                            $matriculaC = $registroCamioneta["Matricula"];
                            echo '<option value="' . $matriculaC . '">' . $matriculaC . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label class="container__label 2">Paquetes</label>
                <select name="paquete" class="container_input">
                    <?php
                    require('../../../db.php');
                    $sentenciaPaquete = "SELECT * FROM `paquete` WHERE Estado = 'En 2do QuickCarry'"; //toma todos los lotes de la tabla lote
                    $filas2 = $conn->query($sentenciaPaquete); //hace la consulta de los lotes
                    foreach ($filas2->fetch_all(MYSQLI_ASSOC) as $fila2) { //convierte el json devuelto en un array para cada lote
                        echo '<option value="' . $fila2['IdPaquete'] . '">' . $fila2['IdPaquete'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="botones-container">
                <a href="V_agregarPaqueteCamioneta.php"><input type="submit" value="Asignar" class="boton 3"></a>
                <a href="V_agregarPaqueteCamioneta.php" class="boton 4">Volver</a>
            </div>
        </form>
    </div>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Package to truck");
                $("h2").text("Assign a package to a van");
                $(".1").text("License plate");
                $(".2").text("Packages");
                $(".3").val("Assign");
                $(".4").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Paquete a camioneta");
                $("h2").text("Asignar un paquete a una camioneta");
                $(".1").text("Matrícula");
                $(".2").text("Paquetes");
                $(".3").val("Asignar");
                $(".4").text("Volver");
            })
})
        </script>
</body>

</html>


<?php
if (isset($_GET["mensaje"])) {
    $response = $_GET["mensaje"]; ?>

    <h1 class="p_error1">
        <?php echo $response; ?>
    </h1>
    <!-- Falta css para este error -->
    <?php
}
?>
