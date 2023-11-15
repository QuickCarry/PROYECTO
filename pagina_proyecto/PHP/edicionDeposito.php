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
    <link rel="stylesheet" href="../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Deposito</title>
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
       $id = $_GET["id"];
    }
    
    $sentencia="SELECT * from `almacencarry` WHERE IDCarry = '$id'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
	$id=$fila["IDCarry"]
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edición</h2>
        <form class="container__form" action="../PHP/editarDeposito.php" method="post">
            <input type="hidden" value="<?php echo $fila['IDCarry'];?>" name="idcarry"> 
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
            <label for="calle" class="container__label 2">Ruta</label>
            <input type="text" value="<?php echo $fila['Ruta'];?>" name="ruta" class="container_input">
        </div>
        <div class="botones-container">
            <input type="submit" value="Confirmar" class="boton 3">
            <a href="gestion_depositos.php" class="boton 4">Volver</a>
        </div>
    </form>
    </div>
	<?php 
	};
	?>
<script src="../JS/confirmacionDeposito.js"></script>
<script>
   $(document).ready(function(){
    $(".idioma-ingles").click(function(){
        $("h2").text("Editing panel");
        $(".1").text("Departament");
        $(".2").text("Route");
        $(".3").val("Confirm");
        $(".4").text("Go Back");
        $("title").text("Deposit");
    });

    $(".idioma-espana").click(function(){
        $("h2").text("Panel de edición");
        $(".1").text("Departamento");
        $(".2").text("Ruta");
        $(".3").val("Confirmar");
        $(".4").text("Volver");
        $("title").text("Deposito");
    });
});

        </script>
</body>

</html>
 <?php
//require ('db.php');
//if(isset($_POST['idcarry']) && isset($_POST['departamento']) && isset($_POST['ruta'])){
 //   $id = $_POST["idcarry"];
//    $departamento = $_POST["departamento"];
//    $ruta = $_POST["ruta"];

//    $modificacion="UPDATE `almacencarry` SET `Departamento`='$departamento',`Ruta`='$ruta' WHERE IDCarry = '$id'";
//    $resultadoModificar=$conn->query($modificacion);
//    if($resultadoModificar){
        //header("Location: gestion_depositos.php");
//        echo '<script type="text/javascript">window.location.href = "gestion_depositos.php"</script>';
//    }else{
//        echo "<script>alert('No se pudo modificar');</script>";
//    }
//}
?>

