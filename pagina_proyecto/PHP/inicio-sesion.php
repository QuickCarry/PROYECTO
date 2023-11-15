<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/inicio-sesion.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../HTML/index.html"> <img src="../IMAGES/LOGO_SISTEMA.png" alt=""></a>
        </div>
        <nav class="menu">
            <a href="../HTML/index.html" class="inicioo">INICIO</a>
            <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma-espana"></a>
            <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
        </nav>
    </header>
    <div class="container">
        <div class="login">
            <h1>INICIAR SESIÓN</h1>
            <hr>
            <div class="login-input">
            <form action="controladorlogin.php" method="post" id="loginForm">
                <div class="input-box"><input type="email" name="correo" class="correo" id="login-input" placeholder="Correo eléctronico..." required>
                </div>
                <div class="input-box"><input type="password" name="contrasenia" class="contrasenia" id="login-input" placeholder="Contraseña..." required>
                </div>
                <button type="submit" class="boton">Iniciar sesión </button>
            </form>
        </div>
        </div>
        
<?php
    if(isset($_GET["mensaje"])){
        $response = $_GET["mensaje"];?>
        <h1 class="p_error1"><?php echo $response; ?></h1>
        <?php
    }
    ?>
    </div>
    
    <footer class="footer">
        <div class="container-footer">
            <div class="box">
                <h4 class="R-S">REDES SOCIALES</h4>
                <div class="redes-sociales">
                    <a href="#"><img src="../IMAGES/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="../IMAGES/instagram.png" alt="instagram"></a>
                    <a href="#"><img src="../IMAGES/twitter.png" alt="twitter"></a>
                </div>
            </div>
            <div class="box">
                <h4 class="contactanos-title">CONTACTANOS</h4>
                <div class="contactanos">
                    <p class="contactanos-correo">CORREO: </p>  <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox">quickcarry830@gmail.com</a>
                    </p>
                    <p class="contactanos-tel">TEL: xxx-xxx-xxx</p>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $(".inicioo").text("HOME");
                    $("h1").text("LOGIN");
                    $(".correo").attr("placeholder","E-mail...");
                    $(".contrasenia").attr("placeholder","Password...");
                    $("button").text("Login");
                    $(".R-S").text("SOCIAL NETWORKS");
                    $(".contactanos-title").text("CONTACT US");
                    $(".contactanos-correo").text("MAIL:quickcarry830@gmail.com");
                    $(".tel").text("PHONE: xxx-xxx-xxx");
                })
                $(".idioma-espana").click(function(){
                    $(".inicioo").text("INICIO");
                    $("h1").text("INICIAR SESIÓN");
                    $(".correo").attr("placeholder","Correo Eléctronico...");
                    $(".contrasenia").attr("placeholder","Contraseña...");
                    $("button").text("Iniciar Sesión");
                    $(".R-S").text("REDES SOCIALES");
                    $(".contactanos-title").text("CONTACTANOS");
                    $(".contactanos-correo").text("CORREO:quickcarry830@gmail.com");
                    $(".tel").text("TEL: xxx-xxx-xxx");
                })
            })
        </script>
    </footer >
</body>

</html>
