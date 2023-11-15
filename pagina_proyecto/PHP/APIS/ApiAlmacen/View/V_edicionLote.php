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
    <link rel="stylesheet" href="../../../../STYLES/lote.css">
    <link rel="icon" type="image/x-icon" href="../../../../IMAGES/LOGO_ICONO.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Lotes</title>
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
    $id = $_GET["id"];
    $sentencia="SELECT * from `lote` WHERE IdLote = '$id'";
    $filas=$conn->query($sentencia);
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){
        ?>
    <div class="container-add">
        <h2 class="container__title">Panel de edicion</h2>
        <form class="container__form" action="../Controller/C_edicionLote.php" method="post">
        <input type="hidden" value="<?php echo $fila['IdLote'];?>" name="id">    
        <div class="form-row">
            <label for="destino"  class="container__label 1">Destino</label>
            <select name="destino" class="container_input" id="destino">
                <option value="Montevideo" <?php if($fila['DestinoLote'] == "Montevideo"){?> selected <?php }?>>Montevideo</option>
                <option value="Canelones" <?php if($fila['DestinoLote'] == "Canelones"){?> selected <?php }?>>Canelones</option>
                <option value="San Jose" <?php if($fila['DestinoLote'] == "San jose"){?> selected <?php }?>>San Jose</option>
                <option value="Maldonado" <?php if($fila['DestinoLote'] == "Maldonado"){?> selected <?php }?>>Maldonado</option>
                <option value="Rocha" <?php if($fila['DestinoLote'] == "Rocha"){?> selected <?php }?>>Rocha</option>
                <option value="Colonia" <?php if($fila['DestinoLote'] == "Colonia"){?> selected <?php }?>>Colonia</option>
                <option value="Lavalleja" <?php if($fila['DestinoLote'] == "Lavalleja"){?> selected <?php }?>>Lavalleja</option>
                <option value="Florida" <?php if($fila['DestinoLote'] == "Florida"){?> selected <?php }?>>Florida</option>
                <option value="Flores" <?php if($fila['DestinoLote'] == "Flores"){?> selected <?php }?>>Flores</option>
                <option value="Soriano" <?php if($fila['DestinoLote'] == "Soriano"){?> selected <?php }?>>Soriano</option>
                <option value="Durazno" <?php if($fila['DestinoLote'] == "Durazno"){?> selected <?php }?>>Durazno</option>
                <option value="Treinta y Tres" <?php if($fila['DestinoLote'] == "Treinta y Tres"){?> selected <?php }?>>Treinta y Tres</option>
                <option value="Rio Negro" <?php if($fila['DestinoLote'] == "Rio Negro"){?> selected <?php }?>>Rio Negro</option>
                <option value="Cerro Largo" <?php if($fila['DestinoLote'] == "Cerro Largo"){?> selected <?php }?>>Cerro Largo</option>
                <option value="Tacuarembó" <?php if($fila['DestinoLote'] == "Tacuarembó"){?> selected <?php }?>>Tacuarembó</option>
                <option value="Paysandú" <?php if($fila['DestinoLote'] == "Paysandú"){?> selected <?php }?>>Paysandú</option>
                <option value="Rivera" <?php if($fila['DestinoLote'] == "Rivera"){?> selected <?php }?>>Rivera</option>
                <option value="Salto" <?php if($fila['DestinoLote'] == "Salto"){?> selected <?php }?>>Salto</option>
                <option value="Salto" <?php if($fila['DestinoLote'] == "Artigas"){?> selected <?php }?>>Artigas</option>
                
            </select>
        </div>    
        <div class="form-row">
            <label for="estado"class="container__label 2">Estado</label>
                <select name="estado" class="container_input">
                    <option value="En preparacion 3">En preparacion</option>
                    <option value="En camino 4">En camino</option>
                    <option value="Entregado 5">Entregado</option>
                </select>
        </div>
            <div class="botones-container">
                <input type="submit" value="Confirmar" class="boton 6">
                <a href="V_Lote.php" class="boton 7">Volver</a>
            </div>
        </form>
    </div>   
        <?php
        
    };

if(isset($_GET["mensaje"])){
    $response = $_GET["mensaje"];?> 
            
   <h1 class="p_error1"><?php echo $response; ?></h1>
    <!-- Falta css para este error -->
   <?php
}
?> 
<script src="../JS/confirmacionLote.js"></script>
<script>
  $(document).ready(function(){
    $(".idioma-ingles").click(function(){
      $("title").text("Lots");
      $("h2").text("Editing panel");
      $(".1").text("Destination");
      $(".2").text("Status");
      $(".3").text("In preparation");
      $(".4").text("On the way");
      $(".5").text("Delivered");
      $(".6").val("Confirm");
      $(".7").text("Go Back");
      // Cambia las opciones del segundo select
      $("select[name='estado'] option[value='En preparacion 3']").text("In preparation");
      $("select[name='estado'] option[value='En camino 4']").text("On the way");
      $("select[name='estado'] option[value='Entregado 5']").text("Delivered");
    });

    $(".idioma-espana").click(function(){
      $("title").text("Lotes");
      $("h2").text("Panel de edición");
      $(".1").text("Destino");
      $(".2").text("Estado");
      $(".3").text("En preparación");
      $(".4").text("En camino");
      $(".5").text("Entregado");
      $(".6").val("Confirmar");
      $(".7").text("Volver");

      // Restaura las opciones del segundo select al idioma español si es necesario
      $("select[name='estado'] option[value='En preparacion 3']").text("En preparación");
      $("select[name='estado'] option[value='En camino 4']").text("En camino");
      $("select[name='estado'] option[value='Entregado 5']").text("Entregado");
    });
  });
</script>

</body>

</html>
