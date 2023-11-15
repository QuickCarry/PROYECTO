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
            <label for="nombre" class="container__label 1">Nombre</label>   
            <input type="text" value="<?php echo $fila['nombre']; ?>" name="nombre" class="container_input">
        </div>  
        <div class="form-row">  
            <label for="apellido" class="container__label 2">Apellido</label>
            <input type="text" value="<?php echo $fila['apellido'];?>" name="apellido" class="container_input">
        </div>      
        <div class="form-row">  
            <label for="correo" class="container__label 3">Correo</label>
            <input type="text" value="<?php echo $fila['correo'];?>" name="correo" class="container_input">
        </div>  
        <div class="form-row"> 
            <label for="contraseña" class="container__label 4">Contraseña</label>   
            <input type="text" value="<?php echo $fila['contraseña'];?>" name="contraseña" class="container_input">
        </div>      
        <div class="form-row">
            <label for="cargo" class="container__label 5">Cargo</label>
            <input type="text" value="<?php echo $fila['cargo'];?>" name="cargo" class="container_input">
        </div>      
        <div class="form-row">
            <label for="horario" class="container__label 6">Horario</label>
            <input type="text" value="<?php echo $fila['horario'];?>" name="horario" placeholder="00:00 - 00:00" class="container_input">
        </div>
        <div class="botones-container">      
        <input type="submit" value="Confirmar" class="boton 7">
        <a href="gestion_usuarios.php" class="boton 8">Volver</a>
        </div>
           
    </form>
        
        <?php
        
    }
}
?>
    </div>
<script src="../JS/confirmacionUsuarios.js"></script>
<script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Users");
                $("h2").text("Editing panel");
                $(".1").text("Name");
                $(".2").text("Last name");
                $(".3").text("Mail");
                $(".4").text("Password");
                $(".5").text("Rol");
                $(".6").text("Schedule");
                $(".7").val("Confirm");
                $(".8").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Usuarios");
                $("h2").text("Panel de edición");
                $(".1").text("Nombre");
                $(".2").text("Apellido");
                $(".3").text("Correo");
                $(".4").text("Contraseña");
                $(".5").text("Cargo");
                $(".6").text("Horario");
                $(".7").val("Confirmar");
                $(".8").text("Volver");
            })
})
        </script>
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
	echo '<script type="text/javascript">window.location.href = "gestion_usuarios.php"</script>';
        //header("Location: ../PHP/gestion_usuarios.php");
    }else{
        echo "<script> alert('No se pudo modificar'); </script>";
    }
}
?>
