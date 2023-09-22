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
    <?php
    require('db.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    
    $sentencia="SELECT * from `usuarios` WHERE id = '$id'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edicion</h2>
        <form class="container__form" action="../PHP/editarPersona.php" method="post">
            <input type="hidden" value="<?php echo $fila['id'];?>" name="id"> 
        <div class="form-row">
            <label for="nombre" class="container__label">Nombre</label>   
            <input type="text" value="<?php echo $fila['nombre']; ?>" name="nombre" class="container_input">
        </div>  
        <div class="form-row">  
            <label for="apellido" class="container__label">Apellido</label>
            <input type="text" value="<?php echo $fila['apellido'];?>" name="apellido" class="container_input">
        </div>      
        <div class="form-row">  
            <label for="correo" class="container__label">Correo</label>
            <input type="text" value="<?php echo $fila['correo'];?>" name="correo" class="container_input">
        </div>  
        <div class="form-row"> 
            <label for="contraseña" class="container__label">Contraseña</label>   
            <input type="text" value="<?php echo $fila['contraseña'];?>" name="contraseña" class="container_input">
        </div>      
        <div class="form-row">
            <label for="cargo" class="container__label">Cargo</label>
            <input type="text" value="<?php echo $fila['cargo'];?>" name="cargo" class="container_input">
        </div>      
        <div class="form-row">
            <label for="horario" class="container__label">Horario</label>
            <input type="text" value="<?php echo $fila['horario'];?>" name="horario" placeholder="00:00 - 00:00" class="container_input">
        </div>      
        <input type="submit" value="CONFIRMAR" class="container__submit">
           
    </form>
        
        <?php
        
    }
}
?>
    </div>
<script src="../JS/confirmacionUsuarios.js"></script>
</body>

</html>

<?php
require('db.php');
if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['cargo']) && isset($_POST['horario'])){
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$contraseña = $_POST["contraseña"];
$cargo = $_POST["cargo"];
$hora = $_POST["horario"];

$modificacion="UPDATE `usuarios` SET `nombre`='$nombre',`apellido`='$apellido',`correo`='$correo',`contraseña`='$contraseña',`cargo`='$cargo',`horario`='$hora' WHERE id = '$id'";
$resultadoModificar=$conn->query($modificacion);
    
 
    if($cargo === "Chofer"){
        $tomarchofer="SELECT * FROM `chofer` WHERE `Ci`= '$id'";
        $control=$conn->query($tomarchofer);
        if (!($control)) { //Condicional por si se quiere modificar algo de un chofer sin modificar el cargo
            $sentenciaChofer="INSERT INTO `chofer`(`Ci`, `NombreCompleto`, `Horarios`, `correo`, `contraseña`,`cargo`) VALUES ('$id','$nombre','$hora','$correo','$contraseña', '$cargo')";
            $fin = $conn->query($sentenciaChofer);    
        }elseif($control) {
            $updatechofer="UPDATE `chofer` SET `NombreCompleto`='$nombre',`Horarios`='$hora' WHERE `Ci` = '$id'";
            $fin = $conn->query($updatechofer);
        }
    }elseif ($cargo !== "Chofer"){
        $sentenciaChofer="DELETE FROM `chofer` WHERE `Ci` = $id";
        $fin = $conn->query($sentenciaChofer);
    }
    if($resultadoModificar || $fin){
        header("Location: ../PHP/gestion_usuarios.php");
    }else{
        echo "<script> alert('No se pudo modificar'); </script>";
    }
}
?>