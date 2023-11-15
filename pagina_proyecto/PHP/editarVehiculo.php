<?php
session_start();
//error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}

// $tipoG = $_GET["tipo"];
// $choferG = $_GET["chofer"];
// $matricula = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/depositos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Agregar vehiculo</title>
</head>

<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>

    <div class="container-add">
        <h2 class="container__title">Registrar Vehiculo</h2>
        <form action="edicionVehiculo.php" method="post" class="container__form">
            <div class="form-row">
                <label class="container__label" hidden>Matricula:</label>
                <input name="matricula" type="text" class="container_input" value="<?php echo $_GET["id"]; ?>"
                    hidden></input>
            </div>
            <div class="form-row">
                <label class="container__label">Chofer</label>
                <select name="chofer" class="container_input">
                    <?php
                    require('db.php');
                    
                    $sentencia = "SELECT * FROM `chofer`"; //toma todos los usuarios de la tabla chofer
                    $filas = $conn->query($sentencia); //hace la consulta de los usuarios
                    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada lote
                        $ci = $fila["Ci"];
                        echo '<option value="' . $fila['Ci'] . '">' . $fila['Ci'] . " | " . $fila['NombreCompleto'] . '</option>';
                    }
                    ?>
                </select>

            </div>
            <div class="form-row">
                <label class="container__label">Servicio:</label>
                <input name="servicio" type="text" class="container_input"></input>
            </div>
            <!-- <div class="form-row">
                <label class="container__label">tipo:</label>
                <select name="tipo" class="container_input">
                    <option value="Camion" <?php if($tipoG == "Camion"){
                        ?> selected <?php
                    }
                        ?>>Camion</option>
                    <option value="Camioneta" <?php if($tipoG == "Camioneta"){
                        ?> selected <?php } ?>> Camioneta </option>
                </select>

            </div> -->
            <a href="gestion_vehiculos.php"><input type="submit" value="Registrar" class="container__submit"></a>
            <a href="gestion_vehiculos.php" class="boton">Volver</a>
        </form>
    </div>
</body>

</html>

<?php
