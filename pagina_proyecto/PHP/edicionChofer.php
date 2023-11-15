<?php    
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}

require('db.php');

if(isset($_POST['Ci']) && isset($_POST['horarios']) && isset($_POST['Nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])){
    $id = $_POST["Ci"];
    $horarios = $_POST["horarios"];
    $Nombre = $_POST["Nombre"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    
    // Actualizar la tabla 'chofer'
    $modificacionChofer = "UPDATE `chofer` SET `NombreCompleto`='$Nombre', `Horarios`='$horarios',`correo`='$correo',`contraseña`='$contraseña' WHERE Ci = '$id'";
    $resultadoModificarChofer = $conn->query($modificacionChofer);

    // Actualizar la tabla 'usuarios'
    $modificacionUsuarios = "UPDATE `usuarios` SET `nombre`='$Nombre',`horario`='$horarios',`correo`='$correo',`contraseña`='$contraseña' WHERE id = '$id'";
    $resultadoModificarUsuarios = $conn->query($modificacionUsuarios);

    if($resultadoModificarChofer && $resultadoModificarUsuarios){
        header("Location: gestion_choferes.php");
    }else{
        echo "<script>alert('No se pudo modificar');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Choferes</title>
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
    <?php
    if(isset($_GET['id'])){
        $id = $_GET["id"];
    
    ?>

    <?php
    $sentencia="SELECT * from `chofer` WHERE Ci = '$id'";
    $filas=$conn->query($sentencia);

    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
    ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edición</h2>
        <form class="container__form" action="../PHP/edicionChofer.php" method="post">
            <input type="hidden" value="<?php echo $fila['Ci'];?>" name="Ci" class="container_input">
            <div class="form-row">
                <label for="camion" class="container__label 1">Horarios</label>
                <input type="text" value="<?php echo $fila['Horarios']; ?>" name="horarios" class="container_input">
            </div>
            <div class="form-row">    
                <label for="camion" class="container__label 2">Nombre</label>
                <input type="text" value="<?php echo $fila['NombreCompleto'];?>" name="Nombre" class="container_input">
            </div>   
            <div class="form-row">
                <label for="camion" class="container__label 3">Correo</label>
                <input type="text" value="<?php echo $fila['correo'];?>" name="correo" class="container_input">
            </div>
            <div class="form-row">
                <label for="camion" class="container__label 4">Contraseña</label>
                <input type="text" value="<?php echo $fila['contraseña']?>" name="contraseña" class="container_input">
            </div>    
            <div class="botones-container">
                <input type="submit" value="Confirmar" class="boton 5">
                <a href="gestion_choferes.php" class="boton 6">Volver</a>
            </div>
            

                
        </form>
    <?php
    }
}
    ?>
    </div>
    <script src="../JS/confirmacionChofer.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Drivers");
                $("h2").text("Editing panel");
                $(".1").text("Schedules");
                $(".2").text("Name");
                $(".3").text("Mail");
                $(".4").text("Password");
                $(".5").val("Confirm");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Choferes");
                $("h2").text("Panel de edición");
                $(".1").text("Horarios");
                $(".2").text("Nombre");
                $(".3").text("Correo");
                $(".4").text("Contraseña");
                $(".5").val("Confirmar");
            })
})
        </script>
</body>
</html>
