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
    <title>Vehiculos</title>
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
    <h1>Gestión de vehiculos</h1>
    <div class="table-container">
        <div class="table-header G">
                <div class="table-cell H 1">Matricula</div>
                <div class="table-cell H 2">Camionero</div>
                <div class="table-cell H 3">Tipo</div>
                <div class="table-cell H 4">Eliminar</div>
            <?php
            require('db.php');
            $sentenciaVehiculo = "SELECT * FROM `vehiculo`";
            $filas = $conn->query($sentenciaVehiculo);
            foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
                $idcamion = $fila['Matricula'];
                
                $consultaCamioneta = "SELECT * FROM `camioneta` WHERE Matricula = '$idcamion'";
                $resultadoCamioneta = $conn->query($consultaCamioneta);
                if( mysqli_num_rows($resultadoCamioneta) > 0 ) {
                    $tipo = "Camioneta";    
                }else{
                    $tipo = "Camion";
                }
                $sentenciaChofer = "SELECT * FROM `conduce` WHERE Matricula = '$idcamion'";
                $filas2 = $conn->query($sentenciaChofer);
                
                ?>
                    <div class="table-cell V 1">Matricula</div>
                    <div class="table-cell"><?php echo $fila['Matricula'];?></div>
                    <div class="table-cell V 2">Camionero</div>
                    <div class="table-cell"><?php 
                    if(mysqli_num_rows($filas2) > 0) {
                        foreach ($filas2->fetch_all(MYSQLI_ASSOC) as $fila2) {
                            echo $fila2["Ci"];
                        }
                    }else{
                        echo "-";
                    }?>
                    </div>
                    <div class="table-cell V 3">Tipo</div>
                    <div class="table-cell"><?php echo $tipo; ?></div>
                    <div class="table-cell V 4">Eliminar</div>
                    <div class="table-cell">
                    <a href="deleteVehiculo.php?id=<?php echo $fila2["Matricula"];?>"><img src="../IMAGES/equis.svg" alt="" class="x" id="item_delete"></a>
                </div>
                    <?php
                }
            if (isset($_GET["mensaje"])) {
                $response = $_GET["mensaje"]; ?>

                <h1 class="p_error1">
                    <?php echo $response; ?>
                </h1>
                <!-- Falta css para este error -->
                <?php
            }
            ?>
        </table>
    </div>
    <div class="botones-container">
        <a href="agregarVehiculo.php" class="boton 5">Agregar</a>
        <a href="../HTML/admin.php" class="boton 6">Volver</a>
        <a href="asignacionCamionChofer.php" class="boton 7">Asignar vehiculo a chofer</a>
    </div>
    <script src="../JS/confirmacionVehiculo.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("h1").text("Vehicle management");
                $(".1").text("License plate");
                $(".2").text("Truck driver");
                $(".3").text("Type");
                $(".4").text("Delete");
                $(".5").text("Add");
                $(".6").text("Go Back");
                $(".7").text("Assign vehicle to driver");
                $("title").text("Vehicles");
            })
            $(".idioma-espana").click(function(){
                $("h1").text("Gestión de vehiculos");
                $(".1").text("Matricula");
                $(".2").text("Camionero");
                $(".3").text("Tipo");
                $(".4").text("Eliminar");
                $(".5").text("Agregar");
                $(".6").text("Volver");
                $(".7").text("Asignar vehiculo a chofer");
                $("title").text("Vehiculos");
            })
})
        </script>
</body>

</html>