<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Productos</title>
</head>
<body>
    <header>
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>
    <?php
    require('db.php');
    if(isset($_GET['id'])){
        $idpaquete = $_GET['id'];
    

    $sentencia="SELECT * from `paquete` WHERE IdPaquete = '$idpaquete'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edición</h2>
            <form class="container__form" action="../PHP/edicionPaqueteF.php" method="post">
                <input type="hidden" value="<?php echo $fila['IdPaquete'];?>" name="id">
                <div class="form-row">      
                    <label for="destino" class="container__label">Peso</label>  
                    <input type="text" value="<?php echo $fila['Peso']; ?>" name="peso" class="container_input">
                </div>
                <div class="form-row"> 
                    <label for="cliente" class="container__label">Tipo</label>
                    <input type="text" value="<?php echo $fila['Tipo'];?>" name="tipo" class="container_input">
                </div>    
                <div class="form-row"> 
                    <label for="fecha" class="container__label">Cliente</label>
                    <input type="text" value="<?php echo $fila['Cliente'];?>" name="cliente" class="container_input">
                </div>
                <div class="form-row"> 
                    <label for="lote" class="container__label">Destino</label>
                    <input type="text" value="<?php echo $fila['Ubicacion'];?>" name="destino" class="container_input">
                </div>    
                <div class="form-row"> 
                    <label for="hora" class="container__label">Fecha</label>
                    <input type="text" value="<?php echo $fila['FechaRegistro'];?>" name="fecha" class="container_input">
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
    </form>
        
        <?php
    
    }
    }
require('db.php');
    if(isset($_POST['id']) && isset($_POST['destino']) && isset($_POST['cliente']) && isset($_POST['fecha']) && isset($_POST['estado']) && isset($_POST['peso'])){
        $idpaquete = $_POST["id"];
        $destino = $_POST["destino"];
        $cliente = $_POST["cliente"];
        $fecha = $_POST["fecha"];
        $peso = $_POST["peso"];
        $tipo = $_POST["tipo"];
        // $lote = $_POST["lote"];
        // $horaEnvio = $_POST["horaEnvio"];
        $estado = $_POST["estado"];
        $modificacion="UPDATE `paquete` SET `Peso`='$peso',`Tipo`='$tipo',`Cliente`='$cliente',`Estado`='$estado',`Ubicacion`='$destino',`FechaRegistro`='$fecha'  WHERE IdPaquete = '$idpaquete'";
        $resultadoModificar=$conn->query($modificacion);

            if($resultadoModificar){
                header("Location: ../PHP/ver_paquetesF.php");
            }else{
                echo "<script> alert('No se pudo modificar'); </script>";
            }
}
?>

<script src="../JS/confirmacionPaquete.js"></script>

</body>

</html>