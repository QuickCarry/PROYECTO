<?php   
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
    $modificacionUsuarios = "UPDATE `usuarios` SET `nombre`='$Nombre',`horario`='$horarios' WHERE id = '$id'";
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
    <title>Choferes</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
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
                <label for="camion" class="container_label">Horarios</label>
                <input type="text" value="<?php echo $fila['Horarios']; ?>" name="horarios" class="container_input">
            </div>
            <div class="form-row">    
                <label for="camion" class="container_label">Nombre</label>
                <input type="text" value="<?php echo $fila['NombreCompleto'];?>" name="Nombre" class="container_input">
            </div>   
            <div class="form-row">
                <label for="camion" class="container_label">Correo</label>
                <input type="text" value="<?php echo $fila['correo'];?>" name="correo" class="container_input">
            </div>
            <div class="form-row">
                <label for="camion" class="container_label">contraseña</label>
                <input type="text" value="<?php echo $fila['contraseña']?>" name="contraseña" class="container_input">
            </div>    
                <input type="submit" value="Confirmar" class="container__submit">
        </form>
    <?php
    }
}
    ?>
    </div>
    <script src="../JS/confirmacionChofer.js"></script>
</body>
</html>
