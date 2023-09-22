<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Deposito</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>
    <?php
    require('db.php');
    if(isset($_GET['id'])){
       $id = $_GET["id"];
    }
    
    $sentencia="SELECT * from `almacenescarry` WHERE IDCarry = '$id'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edición</h2>
        <form class="container__form" action="../PHP/edicionDeposito.php" method="post">
            <input type="hidden" value="<?php echo $fila['IDCarry'];?>" name="idcarry"> 
        <div class="form-row">
            <label for="departamento" class="container__label">Departamento</label>
            <input type="text" value="<?php echo $fila['Departamento']; ?>" name="departamento" class="container_input">
        </div>
        <div class="form-row">
            <label for="calle" class="container__label">Ruta</label>
            <input type="text" value="<?php echo $fila['Ruta'];?>" name="ruta" class="container_input">
        </div>
        <!-- <div class="form-row">
            <label for="numero_puerta" class="container_label">Numero_puerta</label>
            <input type="number" value="<?php echo $fila['numero_puerta'];?>" name="numero_puerta" class="container_input">
        </div> -->
            <input type="submit" value="CONFIRMAR" class="container__submit">
    </form>
        
        <?php
        
    };
require ('db.php');
if(isset($_POST['idcarry']) && isset($_POST['departamento']) && isset($_POST['ruta'])){
    $id = $_POST["idcarry"];
    $departamento = $_POST["departamento"];
    $ruta = $_POST["ruta"];
    
    $modificacion="UPDATE `almacenescarry` SET `Departamento`='$departamento',`Ruta`='$ruta' WHERE IDCarry = '$id'";
    $resultadoModificar=$conn->query($modificacion);
    if($resultadoModificar){
        header("Location: gestion_depositos.php");
    }else{
        echo "<script>alert('No se pudo modificar');</script>";
    }
}
?>
    </div>

<script src="../JS/confirmacionDeposito.js"></script>
</body>

</html>