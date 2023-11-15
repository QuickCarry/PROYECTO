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
    <link rel="stylesheet" href="../STYLES/depositos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Productos</title>
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

    <div class="container-add">
        <h2 class="container__title">Registrar Deposito</h2>
        <form action="../PHP/agregarDeposito.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label 1">Departamento:</label>
            <select name="departamento" class="container_input">
                <option value="Montevideo">Montevideo</option>
                <option value="Canelones">Canelones</option>
                <option value="San Jose">San Jose</option>
                <option value="Maldonado">Maldonado</option>
                <option value="Rocha">Rocha</option>
                <option value="Colonia">Colonia</option>
                <option value="Lavalleja">Lavalleja</option>
                <option value="Florida">Florida</option>
                <option value="Flores">Flores</option>
                <option value="Soriano">Soriano</option>
                <option value="Durazno">Durazno</option>
                <option value="Treinta y Tres">Treinta y Tres</option>
                <option value="Rio Negro">Rio Negro</option>
                <option value="Cerro Largo">Cerro Largo</option>
                <option value="Tacuarembó">Tacuarembó</option>
                <option value="Paysandú">Paysandú</option>
                <option value="Rivera">Rivera</option>
                <option value="Salto">Salto</option>
                <option value="Artigas">Artigas</option>
            </select>
        </div>    
        <div class="form-row">
            <label class="container__label 2">Ruta:</label>
            <input name="Ruta" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label 3">Id</label>
            <input name="id" type="number" class="container_input"></input>
        </div>
        <div class="botones-container">
            <a href="../HTML/admin.php"><input type="submit" value="Registrar" class="boton 4"></a>
            <a href="gestion_depositos.php" class="boton 5">Volver</a>
        </div>
        </form>
    </div>
<script>
   $(document).ready(function(){
    $(".idioma-ingles").click(function(){
        $("h2").text("Editing panel");
        $(".1").text("Departament");
        $(".2").text("Route");
        $(".3").text("Id");
        $(".4").val("Register");
        $(".5").text("Go Back");
        $("title").text("Deposit");
    });

    $(".idioma-espana").click(function(){
        $("h2").text("Panel de edición");
        $(".1").text("Departamento");
        $(".2").text("Ruta");
        $(".3").text("Id");
        $(".4").val("Registrar");
        $(".5").text("Volver");
        
        $("title").text("Deposito");
    });
});

        </script>
</body>
</html>
<?php
    require('db.php');
    if(isset($_POST['departamento']) && isset($_POST['Ruta']) && isset($_POST['id'])){
    $id = $_POST["id"];
    $departamento = $_POST["departamento"];
    $ruta = $_POST["Ruta"];

    $sentencia = "INSERT INTO almacencarry(IDCarry ,Departamento, Ruta) VALUES ('$id','$departamento','$ruta')";
    $resultadoAlta = $conn->query($sentencia);
        if($resultadoAlta){
            //echo "<script>alert('Se ha registrado el deposito con exito'); window.location='/'</script>";
            echo '<script type="text/javascript">window.location.href = "gestion_depositos.php"</script>';
            //header("Location: ../PHP/gestion_depositos.php");
        }else{
        echo "<script>alert('No se pudo añadir');</script>";
        }
}

?>

