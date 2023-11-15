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
    <h1>Gestión de paquetes en tránsito</h1>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H 1">Id Paquete</div>
            <div class="table-cell H 2">Peso</div>
            <div class="table-cell H 3">Tipo</div>
            <div class="table-cell H 4">Cliente</div>
            <div class="table-cell H 5">Destino</div>
            <div class="table-cell H 6">Fecha de registro</div>
            <div class="table-cell H 7">Estado</div>
            <div class="table-cell H 8">Lote</div>
            <div class="table-cell H 9">Editar o Eliminar</div>
            <?php
            require('../../../db.php');
            $sentencia = "SELECT * FROM `paquete`"; //toma todos los paquetes de la tabla paquete
            $filas = $conn->query($sentencia); //hace la consulta de los paquetes
            foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { //convierte el json devuelto en un array para cada paquete
                $id=$fila['IdPaquete']; // toma el id de cada paquete en cada bucle del foreach y lo mete en una variable
                $sentencia_lote = "SELECT IdLote FROM pertenecen WHERE IdPaquete = $id"; //toma los id de los lotes de la tabla pertenecen donde el id del paquete sea igual al id tomado
                $filas2 = $conn->query($sentencia_lote); //hace la consulta de los lotes
                ?>
                    <div class="table-cell V 1">Id Paquete</div>
                    <div class="table-cell"><?php echo $fila['IdPaquete']; ?></div>
                    <div class="table-cell V 2">Peso</div>
                    <div class="table-cell"><?php echo $fila['Peso']; ?></div>
                    <div class="table-cell V 3">Tipo</div>
                    <div class="table-cell"><?php echo $fila['Tipo']; ?></div>
                    <div class="table-cell V 4">Cliente</div>
                    <div class="table-cell"><?php echo $fila['Cliente']; ?></div>
                    <div class="table-cell V 5">Destino</div>
                    <div class="table-cell"><?php echo $fila['DestinoExacto']; ?></div>
                    <div class="table-cell V 6">Fecha de registro</div>
                    <div class="table-cell"><?php echo $fila['FechaRegistro']; ?></div>
                    <div class="table-cell V 7">Estado</div>
                    <div class="table-cell"><?php echo $fila['Estado']; ?></div>
                    <div class="table-cell V 8">Lote</div>
                    <div class="table-cell"><?php 
                    if(mysqli_num_rows($filas2) > 0){
                        foreach($filas2->fetch_all(MYSQLI_ASSOC) as $fila2){
                            echo $fila2["IdLote"];
                        }
                    }else {
                        echo "-";
                    } ?></div>
                    <div class="table-cell V 9">Editar o Eliminar</div>
                    <div class="table-cell">
			<?php 
				if($fila['Estado'] != "Entregado"){
			?>
                        <a href="V_edicionPaqueteA.php?id=<?php echo $fila["IdPaquete"]; ?>"><img src="../../../../IMAGES/editar.svg" alt="" class="edit"></a>
                        <a href="../Model/M_deletePaqueteA.php?id=<?php echo $fila["IdPaquete"]; ?>" class="item_delete"><img src="../../../../IMAGES/equis.svg" class="x"></a>
			<?php 
			}
			?>
                    </div>
            <?php
            
            }
            if(isset($_GET["mensaje"])){
                $response = $_GET["mensaje"];?> 
                <h1 class="p_error1"><?php echo $response; ?></h1>
                <!-- Falta css para este error -->
                <?php
            }
            ?>
        </div>
    </div>

    <div class="botones-container">
        <a href="V_agregarPaqueteA.php" class="boton 10">Agregar</a>
        <a href="../../../../HTML/admin.php" class="boton 11">Volver</a>
    </div>
    <script src="../../../../JS/confirmacionPaquete.js"></script>
    <script>
    $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $("h1").text("Management of packages in transit");
                $(".1").text("Id Package");
                $(".2").text("Weight");
                $(".3").val("Type");
                $(".4").text("Client");
                $(".5").text("Destination");
                $(".6").text("Registration Date");
                $(".7").text("Status");
                $(".8").text("Lot");
                $(".9").text("Edit or delete");
                $(".10").text("Add");
                $(".11").text("Go Back");
                $("title").text("Packages");
            })
            $(".idioma-espana").click(function(){
                $("h1").text("Gestión de paquetes en tránsito");
                $(".1").text("Id Paquete");
                $(".2").text("Peso");
                $(".3").val("Tipo");
                $(".4").text("Cliente");
                $(".5").text("Destino");
                $(".6").text("Fecha de registro");
                $(".7").text("Estado");
                $(".8").text("Lote");
                $(".9").text("Editar o eliminar");
                $(".10").text("Agregar");
                $(".11").text("Volver");
                $("title").text("Paquetes");
            })
})
        </script>
</body>

</html>
