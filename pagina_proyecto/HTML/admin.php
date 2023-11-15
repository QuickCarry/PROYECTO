<?php 
    session_start();
    error_reporting(0);
    $varsession = $_SESSION["usuario"];
    if ($varsession == NULL || $varsession == '') {
        header("Location: ../PHP/inicio-sesion.php");
        die(); // Detén la ejecución del script actual   
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/admin.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt=""></a>
        </div>
        <nav class="menu">
            <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma-espana"></a>
            <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
        </nav>
    </header>
    <h2 class="titulo">ADMINISTRADOR</h2>
    <div class="todo">
        <div class="container">
            <a href="../PHP/APIS/ApiAlmacen/View/V_gestion_paquetes.php" class="boton" id="boton-paquete">Gestion de paquetes</h2></a>
            <a href="../PHP/gestion_usuarios.php" class="boton" id="boton-usuarios">Gestion de usuarios</a>
            <a href="../PHP/gestion_depositos.php" class="boton" id="boton-deposito">Gestion de deposito</a>
            <a href="../PHP/gestion_choferes.php" class="boton" id="boton-chofer">Gestion de choferes</a>
            <a href="../PHP/gestion_vehiculos.php" class="boton" id="boton-vehiculos">Gestion de vehiculos</a>
            <div class="container-regresar">
                <a href="../HTML/index.html" class="boton" id="boton-cerrar_sesion">Cerrar sesión</a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $(".titulo").text("MANAGER");
                $("#boton-paquete").text("Package management");
                $("#boton-usuarios").text("User management");
                $("#boton-deposito").text("Deposit management");
                $("#boton-chofer").text("Driver management");
                $("#boton-vehiculos").text("Vehicle management");
                $("#boton-cerrar_sesion").text("log out");
                $(".rastrear").text("TRACK PACKAGE");
                $(".R-S").text("SOCIAL NETWORKS");
                $(".contactanos-title").text("CONTACT US");
                $(".contactanos-correo").text("MAIL:");
                $(".tel").text("PHONE: xxx-xxx-xxx");
            })
            $(".idioma-espana").click(function(){
                $(".titulo").text("ADMINISTRADOR");
                $("#boton-paquete").text("Gestion de paquetes");
                $("#boton-usuarios").text("Gestion de usuarios");
                $("#boton-deposito").text("Gestion de deposito");
                $("#boton-chofer").text("Gestion de choferes");
                $("#boton-vehiculos").text("Gestion de vehiculos");
                $("#boton-cerrar_sesion").text("Cerrar sesión");
                $(".rastrear").text("RASTREAR PAQUETE");
                $(".R-S").text("REDES SOCIALES");
                $(".contactanos-title").text("CONTACTANOS");
                $(".contactanos-correo").text("CORREO:");
                $(".tel").text("TEL: xxx-xxx-xxx");
            })
        })
    </script>
</body>

</html>