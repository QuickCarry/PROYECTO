<?php
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
if ($varsession == NULL || $varsession == '') {
    header("Location: ../../../inicio-sesion.php");
    die(); // Detén la ejecución del script actual   
}
?>
<?php
function cerrar_lote($idLote)
{
    require("../../../db.php");
    $sentenciaCerrarLote = "UPDATE `lote` SET `EstadoLote`='Cerrado' WHERE IdLote = '$idLote'";
    $listas = $conn->query($sentenciaCerrarLote);
}

function desarmar_lote($idLote)
{
    require("../../../db.php");
    $sentenciaDesarmarLote = "DELETE FROM `pertenecen` WHERE IdLote = '$idLote'";
    $listas = $conn->query($sentenciaDesarmarLote);
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
    <h1>Lotes</h1><br>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id lote</div>
            <div class="table-cell H 2">Estado</div>
            <div class="table-cell H 3">Destino</div>
            <div class="table-cell H 4">Fecha estimada</div>
            <div class="table-cell H 5">Editar o eliminar</div>
            <div class="table-cell H 6">Cerrar lote</div>
            <?php
            require('../../../db.php');
            $sentencia = "SELECT * from `lote`";
            $filas = $conn->query($sentencia);

            foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
                $Lote = $fila['IdLote'];
                $estadoLote = $fila['EstadoLote'];
                $sentenciaTransporta = "SELECT * FROM transporta WHERE IdLote = '$Lote'";
                $resultadoTransporta = $conn->query($sentenciaTransporta);
                foreach ($resultadoTransporta->fetch_all(MYSQLI_ASSOC) as $fila2) {
                    $matricula = $fila2["Matricula"];
                }
                $sentenciaConduce = "SELECT * FROM conduce WHERE Matricula = '$matricula'";
                $resultadoConduce = $conn->query($sentenciaConduce);
                foreach ($resultadoConduce->fetch_all(MYSQLI_ASSOC) as $fila3) {
                    $estado = $fila3["Estado"];
                }
                ?>
                <div class="table-cell V 1">Id lote</div>
                <div class="table-cell">
                    <?php echo $fila['IdLote']; ?>
                </div>
                <div class="table-cell V 2">Estado</div>
                <div class="table-cell">
                    <?php echo $fila['EstadoLote']; ?>
                </div>
                <div class="table-cell V 3">Destino</div>
                <div class="table-cell">
                    <?php echo $fila['DestinoLote']; ?>
                </div>
                <div class="table-cell V 4">Fecha estimada</div>
                <div class="table-cell">
                    <?php echo $fila['fechaEstimada']; ?>
                </div>
                <div class="table-cell V 5">Editar o eliminar</div>
                <div class="table-cell">
                    <a href="V_edicionLote.php?id=<?php echo $fila["IdLote"]; ?>"><img src="../../../../IMAGES/editar.svg"
                            alt="" class="edit"></a>
                    <a href="../Model/M_deleteLote.php?id=<?php echo $fila["IdLote"]; ?>" class="item_delete"><img
                            src="../../../../IMAGES/equis.svg" class="x"></a>
                </div>
                <div class="table-cell V 6">Cerrar lote</div>
                <div class="table-cell">
                    <a href="V_Lote.php?idCerrar=<?php echo $fila["IdLote"]; ?>"><p class="Estado">Cerrar lote</p></a>
                </div>
                <?php
                if ($estadoLote == "En 2do QuickCarry") {
                    ?>
                     <div class="table-cell V">Desarmar lote</div>
                    <div class="table-cell">
                        <a href="../Controller/C_desarmarLote.php?idDesarmar=<?php echo $fila["IdLote"]; ?>"><p class="Estado">Desarmar lote</p></a>
                    </div>
                    <?php
                } ?>
                <?php
            }
            ;
            
            ?>
        </div>
    </div>
    <div class="botones-container">
        <a href="../../../../HTML/funcionario.php" class="boton 8">Volver</a>
    </div>
    <script src="../../../../JS/confirmacionLote.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("title").text("Lots");
                $("h1").text("Lots");
                $(".1").text("Id Lot");
                $(".2").text("Status");
                $(".3").text("Destination");
                $(".4").text("Estimated date");
                $(".5").text("Edit or delete");
                $(".6").text("Close lot");
                $(".7").text("Registration Date");
                $(".8").text("Go Back");
            })
            $(".idioma-espana").click(function(){
                $("title").text("Lotes");
                $("h1").text("Lotes");
                $(".1").text("IdLote");
                $(".2").text("Estado");
                $(".3").text("Destino");
                $(".4").text("Fecha estimada");
                $(".5").text("Editar o eliminar");
                $(".6").text("Cerrar lote");
                $(".7").text("Fecha de Registro");
                $(".8").text("Volver");
            })
})
        </script>
</body>

</html>

<?php
if (isset($_GET["mensaje"])) {
                $response = $_GET["mensaje"]; ?>

                <h1 class="p_error1">
                    <?php echo $response; ?>
                </h1>
                <!-- Falta css para este error -->
                <?php
            }

if (isset($_GET["idCerrar"])) {
    $lote = $_GET["idCerrar"];
    cerrar_lote($lote);
}
if (isset($_GET["idDesarmar"])) {
    $lote = $_GET["idDesarmar"];
    desarmar_lote($lote);
}
?>