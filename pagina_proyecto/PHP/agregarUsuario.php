<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Usuarios</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>

    <div class="container-add">
        <h2 class="container__title">Registrar usuario</h2>
        <form action="../PHP/agregarUsuario.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label">Nombre:</label>
            <input name="name" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label">Apellido:</label>
            <input name="apellido" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label">Correo:</label>
            <input name="correo" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label">Contraseña:</label>
            <input name="contraseña" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label">Cargo:</label>
            <input name="cargo" type="text" class="container_input"></input>
        </div>
        <div class="form-row">
            <label class="container__label">Horario:</label>
            <input name="horario" type="text" class="container_input" placeholder="Hora Entrada - Hora Fin"></input>
        </div>
        <div class="form-row">
            <label class="container__label">Dias laborales:</label>
            <input name="DLaboral" type="text" class="container_input" placeholder="Dia incio - Dia fin"></input>
        </div>
            <a href="../HTML/admin.html" class="registrar"><input type="submit" value="Registrar" class="container__submit"></a>
            
        </form>
    </div>
    <?php
    require('db.php');
    if(isset($_POST['name']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['cargo']) && isset($_POST['horario']) && isset($_POST['DLaboral'])){

        $name = $_POST["name"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];
        $cargo = $_POST["cargo"];
        $horario = $_POST["horario"];
        $DLaboral = $_POST["DLaboral"];

        $sentencia = "INSERT INTO usuarios(nombre, apellido, correo, contraseña, cargo, horario, dias_habiles) VALUES ('$name','$apellido','$correo','$contraseña','$cargo', '$horario', '$DLaboral')";

        $resultadoAlta = $conn->query($sentencia);
        if($cargo === "Chofer"){
            $tomarId = "SELECT `id` FROM `usuarios` WHERE `correo` = '$correo'";
            $filas = $conn->query($tomarId);

            foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
                $idchofer = $fila["id"];
            }
            $sentenciaChofer="INSERT INTO `chofer`(`Ci`, `NombreCompleto`, `Horarios`,`correo`, `contraseña`, `cargo`) VALUES ('$idchofer','$name','$horario','$correo','$contraseña','$cargo')";
            $fin = $conn->query($sentenciaChofer);
        }
    if($resultadoAlta || $fin){
        echo "<script>alert('Se ha registrado el usuario con exito'); window.location='/'</script>";
        header("Location: gestion_usuarios.php");
    }else{
        echo "<script>alert('No se pudo añadir');</script>";
    }
}
?>
</body>
</html>