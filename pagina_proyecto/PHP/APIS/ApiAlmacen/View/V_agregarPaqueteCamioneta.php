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
    <link rel="stylesheet" href="../../../../STYLES/paquete-camioneta.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paquetes y sus camionetas</title>
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
    <h1>Paquetes y sus camionetas</h1><br>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id paquete</div>
            <div class="table-cell H 2">Vehiculo</div>
            <div class="table-cell H 3">Fecha de llegada</div>
            <div class="table-cell H 4">Eliminar</div>
            <?php
            require('../../../db.php');
            $sentencia = "SELECT * from `vahacia`";
            $filas = $conn->query($sentencia);
            foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { ?>
                <div class="table-cell V 1">Id Paquete</div>
                <div class="table-cell">
                    <?php echo $fila['IdPaquete']; ?>
                </div>

                <div class="table-cell V 2">Vehiculo</div>
                <div class="table-cell">
                    <?php echo $fila['Matricula']; ?>
                </div>

                <div class="table-cell V 3">Fecha de llegada</div>
                <div class="table-cell">
                    <?php echo $fila['FechaEntrega']; ?>
                </div>
                <div class="table-cell V 4">Eliminar</div>
                <div class="table-cell"><a
                        href="../Controller/C_deletePaquete-Camioneta.php?id=<?php echo $fila["IdPaquete"]; ?>"
                        class="item_delete"><img src="../../../../IMAGES/equis.svg" class="x"></a>
                </div>
                    <?php
            }
            ;
            if (isset($_GET["mensaje"])) {
                $response = $_GET["mensaje"]; ?>

                    <h1 class="p_error1">
                        <?php echo $response; ?>
                    </h1>
                    <!-- Falta css para este error -->
                    <?php
            }
            ?>
            </div>
        </div>
            <div class="botones-container">
                <a href="V_asignarPaqueteCamioneta.php" class="boton 5">Asignar</a>
                <a href="../../../../HTML/funcionario.php" class="boton 6">Volver</a>
            </div>
            <script src="../../../../JS/confirmacionLote.js"></script>
        </div>
    </div>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Packages and their trucks");
                $("h1").text("Packages and their trucks");
                $(".1").text("Id Package");
                $(".2").text("Vehicle");
                $(".3").text("Arrival date");
                $(".4").text("Delete");
                $(".5").text("Assign");
                $(".6").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Packages and their trucks");
                $("h1").text("Paquetes y sus camionetas");
                $(".1").text("Id Paquete");
                $(".2").text("Vehiculo");
                $(".3").text("Fecha de llegada");
                $(".4").text("Eliminar");
                $(".5").text("Asignar");
                $(".6").text("Volver");
            })
})
        </script>
</body>

</html>
