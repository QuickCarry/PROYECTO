<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/inicio-sesion.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../HTML/index.html"> <img src="../IMAGES/LOGO_SISTEMA.png" alt=""></a>
        </div>
        <nav class="menu">
            <a href="../HTML/index.html">INICIO</a>
            <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma"></a>
            <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma"></a>
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
                <h4>REDES SOCIALES</h4>
                <div class="redes-sociales">
                    <a href="#"><img src="../IMAGES/facebook.png" alt=""></a>
                    <a href="#"><img src="../IMAGES/instagram.png" alt=""></a>
                    <a href="#"><img src="../IMAGES/twitter.png" alt=""></a>
                </div>
            </div>
            <div class="box">
                <h4>CONTACTANOS</h4>
                <div class="contactanos">
                    <p>CORREO: <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank">quickcarry830@gmail.com</a></p>
                    <p>TEL: xxx-xxx-xxx</p>
                </div>
            </div>
        </div>
    </footer >
</body>

</html>