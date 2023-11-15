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
    <link rel="stylesheet" href="../STYLES/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Usuarios</title>
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
        <h2 class="container__title">Registrar usuario</h2>
        <form action="../PHP/agregarUsuario.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label 1">Nombre</label>
            <input name="name" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label 2">Apellido</label>
            <input name="apellido" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label 3">Correo</label>
            <input name="correo" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label 4">Contraseña</label>
            <input name="contraseña" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label 5">Cargo</label>
            <input name="cargo" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label 6">Horario</label>
            <input name="horario" type="text" class="container_input" placeholder="Hora Entrada - Hora Fin"></input>
        </div>
        <div class="form-row">
            <label class="container__label 7">Días laborales</label>
            <input name="DLaboral" type="text" class="container_input" placeholder="Dia incio - Dia fin"></input>
        </div>
        <div class="botones-container">
            <a href="../HTML/admin.html" class="registrar"><input type="submit" value="Registrar" class="boton 8"></a>
            <a href="gestion_usuarios.php" class="boton 9">Volver</a>
        </div>
            
            
        </form>
    </div>
    <?php
    require('db.php');
    if(isset($_POST['name']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['cargo']) && isset($_POST['horario']) && isset($_POST['DLaboral'])){

        $name = $_POST["name"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $contrasenia = $_POST["contraseña"];
        $cargo = $_POST["cargo"];
        $horario = $_POST["horario"];
        $DLaboral = $_POST["DLaboral"];

        $sentencia = "INSERT INTO usuarios(nombre, apellido, correo, contraseña, cargo, horario, dias_habiles) VALUES ('$name','$apellido','$correo','$contrasenia','$cargo', '$horario', '$DLaboral')";

        $resultadoAlta = $conn->query($sentencia);
        if($cargo == "Chofer"){
            $tomarId = "SELECT `id` FROM `usuarios` WHERE `correo` = '$correo'";
            $filas = $conn->query($tomarId);

            foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
                $idchofer = $fila["id"];
            }
            $sentenciaChofer="INSERT INTO chofer(Ci, NombreCompleto, Horarios, correo, contraseña, cargo, DiasHabiles) VALUES ('$idchofer','$name','$horario','$correo','$contrasenia','$cargo','$DLaboral')";
            $fin = $conn->query($sentenciaChofer);
        }
    if($resultadoAlta==true || ($fin==true && $resultadoAlta==true)){
        echo '<script type="text/javascript">window.location.href = "gestion_usuarios.php"</script>';
        //header("Location: gestion_usuarios.php");
    }else{
        echo "<script>alert('No se pudo añadir');</script>";
    }
}
?>
<script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Users");
                $("h2").text("Register user");
                $(".1").text("Name");
                $(".2").text("Last name");
                $(".3").text("Mail");
                $(".4").text("Password");
                $(".5").text("Rol");
                $(".6").text("Schedule");
                $(".7").text("Business days");
                $(".8").val("Register");
                $(".9").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Usuarios");
                $("h2").text("Registrar usuario");
                $(".1").text("Nombre");
                $(".2").text("Apellido");
                $(".3").text("Correo");
                $(".4").text("Contraseña");
                $(".5").text("Cargo");
                $(".6").text("Horario");
                $(".7").text("Dias laborales");
                $(".8").val("Registrar");
                $(".9").text("Volver");
            })
})
        </script>
</body>
</html>
