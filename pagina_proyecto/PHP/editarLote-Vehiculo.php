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
    <link rel="stylesheet" href="../STYLES/Vehiculos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Lotes y sus camiones</title>
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
        
        <h2 class="container__title">Panel de edición</h2>
            <form action="editarLote-Vehiculo.php" method="post" class="container__form">
            <div class="form-row">
                <label class="container__label 1">Vehiculo</label>
                <input name="vehiculo" type="text" class="container_input" value="<?php echo $_GET["vehiculo"];?>"></input>
            </div>
            <div class="form-row">
                <label class="container__label 2">Lote</label>
                <input name="lote" type="number" class="container_input" value="<?php echo $_GET["id"];?>"></input>
            </div>
            <div class="botones-container">
                <a href="asignacionLote-Vehiculo.php" class="registrar"><input type="submit" value="Confirmar" class="boton 3"></a>
                <a href="asignacionLote-Vehiculo.php" class="boton 4">Volver</a>
            </div>
            </form>
        </div>
        <script>
            $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $("title").text("Lots and their trucks");
                    $("h2").text("Editing panel");
                    $(".1").text("Vehicle");
                    $(".2").text("Lot");
                    $(".3").val("Confirm");
                    $(".4").text("Go Back");
                })
                $(".idioma-espana").click(function(){
                    $("title").text("Lotes y sus camiones");
                    $("h2").text("Panel de edición");
                    $(".1").text("Vehiculo");
                    $(".2").text("Lote");
                    $(".3").text("Confirmar");
                    $(".4").val("Volver");
    
                })
            })
        </script>
</body>
</html>

<?php 
// if((isset($_post["vehiculo"]) && !(empty($_POST["vehiculo"]))) && (isset($_POST["lote"]) && !(empty($_POST["lote"])))){
    
//     $Sentenciaedicion = "UPDATE FROM "

// }


?>