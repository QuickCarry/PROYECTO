<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../STYLES/verLote.css">
    <link rel="icon" type="image/x-icon" href="../../../IMAGES/LOGO_ICONO.ico">
    <title>Ver Lotes</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../../../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
    </header>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H">IDLote</div>
            <div class="table-cell H">Destino</div>
            <div class="table-cell H">Dejar lote</div>
            
    
<?php
require("../../db.php");
if(isset($_GET["usuario"]) && isset($_GET["matricula"])){
    $correo=$_GET["usuario"];
    $matricula=$_GET["matricula"];

    $sentenciaLotes = "SELECT * FROM `transporta` WHERE Matricula = '$matricula'";
    $resultadoLotes= $conn->query($sentenciaLotes);

    if(mysqli_num_rows($resultadoLotes) > 0){
        foreach($resultadoLotes->fetch_all(MYSQLI_ASSOC) as $row){
            $lote=$row["IdLote"];
            
            $destinoLote="SELECT DestinoLote FROM `lote` WHERE IdLote = '$lote'";
            $resultadoDestino = $conn->query($destinoLote);

            foreach ($resultadoDestino->fetch_all(MYSQLI_ASSOC) as $value) {
                $destino = $value["DestinoLote"];

                ?> 
                <div class="table-cell V">IDLote</div>
                <div class="table-cell"><?php echo $lote;  ?></div>
                <div class="table-cell V">Destino</div>                        
                <div class="table-cell"><?php echo $destino;?></div>
                <div class="table-cell V">Dejar lote</div>
                <div class="table-cell">                        
                    <a href="../Controller/C_ponerLlegada.php?id=<?php echo $matricula ?>&destino=<?php echo $destino ?>&lote=<?php echo $lote ?>&correo=<?php echo $correo ?>"><p class="Estado">Dejar lote en almacen</p></a>
                </div>
                <?php
                
            }
        }
    }
}
?>  
</div>
</div>
<div class="botones-container">
    <a href="V_Camionero.php?correo=<?php echo $correo?>" class="boton">Regresar</a>
</div>
</body>
</html>
