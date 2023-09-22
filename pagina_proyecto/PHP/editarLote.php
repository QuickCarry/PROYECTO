<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/lote.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Edicion de lote</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>
    <?php
    require('db.php');
    $id = $_GET["id"];
    $sentencia="SELECT * from `lote` WHERE IdLote = '$id'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edicion</h2>
        <form class="container__form" action="../PHP/editarLote.php" method="post">
        <input type="hidden" value="<?php echo $fila['IdLote'];?>" name="id">    
        <div class="form-row">
            <label for="destino"  class="container__label">Destino</label>
            <input type="text" value="<?php echo $fila['DestinoLote'];?>" name="destino"  class="container_input">
        </div>    
        <div class="form-row">
            <label for="container__label">Estado</label>
                <select name="estado" class="container_input">
                    <option value="En preparacion">En preparacion</option>
                    <option value="En camino">En camino</option>
                    <option value="Entregado">Entregado</option>
                </select>
        </div>
                <input type="submit" value="CONFIRMAR" class="container__submit">
        </form>
    </div>   
        <?php
        
    };
?>

<script src="../JS/confirmacionLote.js"></script>
</body>

</html>
<?php
require('db.php');
if(isset($_POST['id']) && isset($_POST['destino']) && isset($_POST['estado'])){
$id = $_POST["id"];
$destino = $_POST["destino"];
$estado = $_POST["estado"];


$modificacion="UPDATE `lote` SET `EstadoLote`='$estado',`DestinoLote`='$destino' WHERE IdLote = '$id'";

$resultadoModificar=$conn->query($modificacion);
    if($resultadoModificar){
        header("Location: ver_lote.php");
    }else{
        echo "<script> alert('No se pudo modificar'); </script>";
    }
}
?>