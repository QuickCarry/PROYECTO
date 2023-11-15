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
    <h1>Gestion de usuarios</h1>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id</div>
            <div class="table-cell H 2">Nombre</div>
            <div class="table-cell H 3">Apellido</div>
            <div class="table-cell H 4">Correo</div>
            <div class="table-cell H 5">Contraseña</div>
            <div class="table-cell H 6">Cargo</div>
	    <div class="table-cell H">Horario</div>
	    <div class="table-cell H">Dias habiles</div>
            <div class="table-cell H 7">Editar o Eliminar</div> 
    <?php
    require('db.php');
    $sentencia="SELECT * from `usuarios`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <div class="table-cell V 1">Id</div>
            <div class="table-cell"><?php echo $fila['id'];?></div>
            <div class="table-cell V 2">Nombre</div>
            <div class="table-cell"><?php echo $fila['nombre']; ?></div>
            <div class="table-cell V 3">Apellido</div>
            <div class="table-cell"><?php echo $fila['apellido'];?></div>
            <div class="table-cell V 4">Correo</div>
            <div class="table-cell"><?php echo $fila['correo'];?></div>
            <div class="table-cell V 5">Contraseña</div>
            <div class="table-cell"><?php echo $fila['contraseña'];?></div>
            <div class="table-cell V 6">Cargo</div>
            <div class="table-cell"><?php echo $fila['cargo'];?></div>
	    <div class="table-cell V">Horario</div>
	    <div class="table-cell"><?php echo $fila['horario'];?></div>
	    <div class="table-cell V">Dias habiles</div>
   	    <div class="table-cell"><?php echo $fila['dias_habiles'];?></div>
            <div class="table-cell V 7">Editar o Eliminar</div> 
            <div class="table-cell">
                <a href="editarPersona.php?id=<?php echo $fila["id"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                <a href="deletePersona.php?id=<?php echo $fila["id"];?>&cargo=<?php echo $fila['cargo']?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
            </div>
        <?php
    }   
?>
        </div>
    </div> 
    <div class="botones-container">
        <a href="agregarUsuario.php" class="boton 8">Agregar</a>   
        <a href="../HTML/admin.php" class="boton 9">Volver</a>
    </div>
    <script src="../JS/confirmacionUsuarios.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Users");
                $("h1").text("User Management");
                $(".1").text("Id");
                $(".2").text("Name");
                $(".3").text("Last name");
                $(".4").text("Mail");
                $(".5").text("Password");
                $(".6").text("Rol");
                $(".7").text("Edit or delete");
                $(".8").text("Add");
                $(".9").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Usuarios");
                $("h1").text("Gestión de usuarios");
                $(".1").text("Id");
                $(".2").text("Nombre");
                $(".3").text("Apellido");
                $(".4").text("Correo");
                $(".5").text("Contraseña");
                $(".6").text("Cargo");
                $(".7").text("Editar o eliminar");
                $(".8").text("Agregar");
                $(".9").text("Volver");
            })
})
        </script>
</body>
</html>
