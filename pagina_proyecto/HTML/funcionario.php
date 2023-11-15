<?php 

session_start();
    error_reporting(0);
    require("../PHP/db.php");
    $varsession = $_SESSION["usuario"];
    $consulta = "SELECT cargo FROM `usuarios` WHERE correo='$varsession'";
    $lista = $conn->query($consulta);
    foreach($lista->fetch_all(MYSQLI_ASSOC) as $fila){ 
        $cargo = $fila["cargo"];
    }
if (($varsession == NULL || $varsession == '') || ($cargo != "Funcionario")) {
    header("Location: ../PHP/inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/f_Almacen.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Funcionario de Deposito</title>
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
    <h2>Funcionario Deposito</h2>
    <div class="todo">
        <div class="container">
            <a href="../PHP/APIS/ApiAlmacen/View/V_agregarLotes.php" class="boton 1">Creación de lotes</a>
            <a href="../PHP/APIS/ApiAlmacen/View/V_agregarPaqueteF.php" class="boton 2">Ingresar Paquetes</a>
            <a href="../PHP/APIS/ApiAlmacen/View/V_paquetesF.php  " class="boton 3">Ver Paquetes</a>
            <a href="../PHP/APIS/ApiAlmacen/View/V_Lote.php" class="boton 4">Ver Lotes</a>
            <a href="../PHP/asignacionLote-Vehiculo.php" class="boton 5">Asignar lote a camion</a>
            <a href="../PHP/APIS/ApiAlmacen/View/V_agregarPaqueteCamioneta.php" class="boton 6">Asignar paquete a camioneta</a>
            <div class="container-regresar">
                <a href="../HTML/index.html" class="boton 7">Cerrar sesión</a>
            </div>
        </div>
    </div>
    <script>
            $(document).ready(function(){
                $(".idioma-ingles").click(function(){
                    $("title").text("Official Deposit");
                    $("h2").text("Official Deposit");
                    $(".1").text("Batch creation");
                    $(".2").text("Enter Package");
                    $(".3").text("View Packages");
                    $(".4").text("View Lots");
                    $(".5").text("Batch assignment to truck");
                    $(".6").text("Package assignment to van");
                    $(".7").text("Log Out");
                })
                $(".idioma-espana").click(function(){
                    $("title").text("Funcionario de Deposito");
                    $("h2").text("Funcionario Deposito");
                    $(".1").text("Creación de lotes");
                    $(".2").text("Ingresar Paquetes");
                    $(".3").text("Ver Paquetes");
                    $(".4").text("Ver Lotes");
                    $(".5").text("Asignar lote a camion");
                    $(".6").text("Asignar paquete a camioneta");
                    $(".7").text("Cerrar Sesión");
                })
            })
        </script>
</body>

</html>