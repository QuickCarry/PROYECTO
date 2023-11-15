<?php 
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: ../../../inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paquetes</title>
</head>
<body>
<header>
        <div class="logo">
            <a href="#"> <img src="../../../../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
        <nav class="menu">
            <a href="#"><img src="../../../../IMAGES/espana.png" alt="" class="idioma-espana"></a>
            <a href="#"><img src="../../../../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
        </nav>
    </header>
    <?php
    require('../../../db.php');
    if(isset($_GET['id'])){
        $idpaquete = $_GET['id'];
    

    $sentencia="SELECT * from `paquete` WHERE IdPaquete = '$idpaquete'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edición</h2>
            <form class="container__form" action="../Controller/C_edicionPaqueteA.php" method="post">
                <input type="hidden" value="<?php echo $fila['IdPaquete'];?>" name="id">
                <div class="form-row">      
                    <label for="destino" class="container__label 1">Peso</label>  
                    <input type="text" value="<?php echo $fila['Peso']; ?>" name="Peso" class="container_input">
                </div>
                <div class="form-row"> 
                    <label class="container__label 2">Tipo</label>
                    <select name="Tipo" class="container_input">
                        <option value="Frágil 3">Frágil</option>
                        <option value="Peligroso 4">Peligroso</option>
                        <option value="Inflamable 5">Inflamable</option>
                    </select>
                </div>    
                <div class="form-row"> 
                    <label for="fecha" class="container__label 6">Cliente</label>
                    <input type="text" value="<?php echo $fila['Cliente'];?>" name="cliente" class="container_input">
                </div>
                <div class="form-row"> 
                    <label for="lote" class="container__label 7">Destino</label>
                    <input type="text" value="<?php echo $fila['DestinoExacto'];?>" name="ubicacion" class="container_input">
                </div>    
                <div class="form-row"> 
                    <label for="hora" class="container__label 8">Fecha</label>
                    <input type="text" value="<?php echo $fila['FechaRegistro'];?>" name="fechaRegistro" class="container_input">
                </div>
                <div class="form-row">
                    <label class="container__label 9">Lote Asignado</label>
                    <select name="lote" class="container_input">
                    <?php 
                    require('../../../db.php');
                    $sentencia = "SELECT * FROM `lote`"; //toma todos los lotes de la tabla lote
                    $filas2 = $conn->query($sentencia); //hace la consulta de los lotes
                    foreach ($filas2->fetch_all(MYSQLI_ASSOC) as $fila2) { //convierte el json devuelto en un array para cada lote
                        $valorActual = $fila2['IdLote'];
                        $selected = ($fila2['IdLote'] == $valorActual) ? 'selected' : '';
                        echo '<option value="'.$fila2['IdLote'] .'">'.$fila2['IdLote'].'</option>';
                    }
                    ?>
                    </select>
                
            </div>
            <div class="botones-container">        
                <input type="submit" value="Confirmar" class="boton 10">
                <a href="V_gestion_paquetes.php" class="boton 11">Volver</a>
            </div>
                </form>
            </div>
    </form>

<?php
}
}
?>
<script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("h2").text("Editing panel");
                $(".1").text("Weight");
                $(".2").val("Type");
                $(".3").text("Fragile");
                $(".4").text("Dangerous");
                $(".5").text("Flammable");
                $(".6").text("Client");
                $(".7").text("Destination");
                $(".8").text("Date");
                $(".9").text("Assigned lot");
                $(".10").val("Confirm");
                $(".11").val("Go Back");
                $("title").text("Packages");
            })
            $(".idioma-espana").click(function(){
                $("h2").text("Panel de edición");
                $(".1").text("Peso");
                $(".2").val("Tipo");
                $(".3").text("Frágil");
                $(".4").text("Peligroso");
                $(".5").text("Inflamable");
                $(".6").text("Cliente");
                $(".7").text("Destino");
                $(".8").text("Fecha");
                $(".9").text("Lote Asignado");
                $(".10").val("Confirmar");
                $(".11").val("Volver");
                $("title").text("Paquetes");
            })
})
        </script>
</body>

</html>
