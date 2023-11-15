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
    <title>Choferes</title>
</head>
<body>
<header>
    <div class="logo">
        <a href="#"><img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
    </div>
    <nav class="menu">
        <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma-espana"></a>
        <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
    </nav>
</header>
    <h1>Gestión de choferes</h1>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id</div>
            <div class="table-cell H 2">Nombre</div>
	    <div class="table-cell H">Apellido</div>
            <div class="table-cell H 3">Horarios</div>
   	    <div class="table-cell H">Dias habiles</div>
            <div class="table-cell H 4">Correo</div>
            <div class="table-cell H 5">Contraseña</div>
            <div class="table-cell H 6">Cargo</div>
            <div class="table-cell H 7">Editar o Eliminar</div>
    
    <?php
    require('db.php');
    $sentencia="SELECT * FROM `chofer`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
	    $id=$fila['Ci'];  ?>
            <div class="table-cell V 1">Id</div>
            <div class="table-cell"><?php echo $fila['Ci'];?></div>
            <div class="table-cell V 2">Nombre</div>
            <div class="table-cell"><?php echo $fila['NombreCompleto'];?></div>
	    <div class="table-cell V">Apellido</div>
	    <div class="table-cell"><?php 
		$selecUser="SELECT * FROM usuarios WHERE id = '$id'";
		$resUser=$conn->query($selecUser);
		foreach($resUser->fetch_all(MYSQLI_ASSOC) as $fila2){
		echo $fila2['apellido'];
		}
		?></div>
            <div class="table-cell V 3">Horarios</div>
            <div class="table-cell"><?php echo $fila['Horarios'];?></div>
	    <div class="table-cell V">Dias habiles</div>
	    <div class="table-cell"><?php echo $fila['DiasHabiles'];?></div>
            <div class="table-cell V 4">Correo</div>
            <div class="table-cell"><?php echo $fila['correo'];?></div>
            <div class="table-cell V 5">Contraseña</div>
            <div class="table-cell"><?php echo $fila['contraseña'];?></div>
            <div class="table-cell V 6">Cargo</div>
            <div class="table-cell"><?php echo $fila['cargo'];?></div>
            <div class="table-cell V 7">Editar o Eliminar</div>
            <div class="table-cell">
                <a href="../PHP/edicionChofer.php?id=<?php echo $fila["Ci"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                <a href="../PHP/deleteChofer.php?id=<?php echo $fila["Ci"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
            </div>
        <?php
    };
?>  
        </div>
    </div>  
    <div class="botones-container">  
        <a href="../HTML/admin.php" class="boton 8">Volver</a></div>
    </div>
        <script src="../JS/confirmacionChofer.js"></script>
        <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Drivers");
                $("h1").text("Driver Management");
                $(".1").text("Id");
                $(".2").text("Name");
                $(".3").text("Schedules");
                $(".4").text("Mail");
                $(".5").text("Password");
                $(".6").text("Rol");
                $(".7").text("Edit or delete");
                $(".8").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Choferes");
                $("h1").text("Gestión de choferes");
                $(".1").text("Id");
                $(".2").text("Nombre");
                $(".3").text("Horarios");
                $(".4").text("Correo");
                $(".5").text("Contraseña");
                $(".6").text("Cargo");
                $(".7").text("Editar o eliminar");
                $(".8").text("Volver");
            })
})
        </script>
</body>
</html>
