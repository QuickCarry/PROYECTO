<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/seguimiento.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Seguimiento</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt=""></a>
        </div>
        <nav class="menu">
            <a href="../HTML/index.html">INICIO</a>
            <a href="#"><img src="../IMAGES/espana.png" alt="" class="idioma-espana"></a>
            <a href="#"><img src="../IMAGES/estados-unidos.png" alt="" class="idioma-ingles"></a>
        </nav>
    </header>
    <?php
    require("db.php");
    if (isset($_POST["codigo"]) && !empty($_POST["codigo"])) {
        $id = $_POST["codigo"];
        $ListarPaquete = "SELECT * FROM `paquete` WHERE IdPaquete = '$id'"; //Busca el paquete en la tabla paquetes para saber si el paquete existe.
        $listasPaquete = $conn->query($ListarPaquete);
        if (mysqli_num_rows($listasPaquete) > 0) {
            foreach ($listasPaquete->fetch_all(MYSQLI_ASSOC) as $listaPaquete) {
                $estadoPaquete = $listaPaquete["Estado"];
            }
            ?><h1 class="paquete">PAQUETE: </h1>  <h1><p><?php echo $id ?></p></h1>
            <div class="container">
            <div class="container2">
            
            <p class="Titulos" id="titulos-paquete">Estado del Paquete:</p>

                <p class="Tipos"><?php echo $estadoPaquete ?></p>
            
            <?php
            $ListarPertenece = "SELECT * FROM `pertenecen` WHERE IdPaquete = '$id'"; //Busca en pertenecen el paquete para saber que lote tiene.
            $ListasPertenece = $conn->query($ListarPertenece);
            if (mysqli_num_rows($ListasPertenece) > 0) {
                foreach ($ListasPertenece->fetch_all(MYSQLI_ASSOC) as $fila2) {
                    $lote = $fila2["IdLote"];
                    ?>
                    <p class="Titulos" id="titulo-lote">ID del Lote:</p>
                        <p class="Tipos"><?php echo $lote ?></p>
                    
                    <?php
                    $ListarLotes = "SELECT * FROM `lote` WHERE IdLote = '$lote'";
                    $listasLote = $conn->query($ListarLotes);
                    foreach ($listasLote->fetch_all(MYSQLI_ASSOC) as $fila21) {
                        $estadoLote = $fila21["EstadoLote"];
                        $destino = $fila21["DestinoLote"];
                    }
                    ?>
                    <p class="Titulos" id="titulo-estado_lote">Estado del Lote: </p>
                        <p class="Tipos"><?php echo $estadoLote ?></p>
                    
                    <?php
                    $ListarTransporta = "SELECT * FROM `transporta` WHERE IdLote = '$lote'"; //Busca el lote en la tabla de transporta para saber que camion lo tiene.
                    $ListasTransporta = $conn->query($ListarTransporta);
                    if (mysqli_num_rows($ListasTransporta) > 0) {
                        foreach ($ListasTransporta->fetch_all(MYSQLI_ASSOC) as $fila3) {
                            $idvehiculo = $fila3["Matricula"];
                            ?>
                            <p class="Titulos" id="titulo-vehiculo">Matricula del Vehiculo:</p>
                                <p class="Tipos"><?php echo $idvehiculo ?></p>
                            
                            <?php
                            $ListarConduce = "SELECT * FROM `conduce` WHERE Matricula = '$idvehiculo'"; //Busca el vehiculo en la tabla conduce para saber que chofer lo conduce.
                            $ListasConduce = $conn->query($ListarConduce);
                            foreach ($ListasConduce->fetch_all(MYSQLI_ASSOC) as $fila4) {
                                $estadoTrayecto = $fila4["Estado"];
                                $Chofer = $fila4["Ci"];
                                ?>
                                <p class="Titulos" id="titulo-conductor">ID del Conductor: </p>
                                    <p class="Tipos"><?php echo $Chofer ?></p>
                                
                                <?php
                            }
                        }
                    } else {
                        echo "El Lote no esta en ningun vehiculo";
                    }
                }
            } else {
                $lote= "No esta asignado a ningun lote";
                $buscaCamioneta="SELECT * FROM `vahacia` WHERE `IdPaquete`='$id'";
                $resultado=$conn->query($buscaCamioneta);
                if(mysqli_num_rows($resultado) > 0) { 
                foreach ($ListasTransporta->fetch_all(MYSQLI_ASSOC) as $fila4) {
                    $matricula = $fila4["Matricula"]; ?>
                    <p class="Titulos" id="titulo-vehiculo">Matricula del Vehiculo:</p>
                        <p class="Tipos"><?php echo $matricula; ?></p>
                    <?php
                }
                }
            }
        } else {
            $mensajeError = "El paquete no existe";
            header("Location: ../HTML/rastrear.html?mensaje=$mensajeError");
        }
    }
    
    if($estadoPaquete == "En lote"){
        if((isset($estadoLote) && $estadoLote == "En QuickCarry") || (isset($estadoLote) && $estadoLote == "Cerrado")) {?>
    <p class="Titulos"><?php echo "En central de Quick Carry" ?></p>
    <?php
        }elseif( isset($estadoLote) && $estadoLote == "En Camion") {
            if($estadoTrayecto == "Detenido"){?>
    <p class="Titulos"><?php echo "En camion que esta en el almacen secundario de Quick Carry" ?></p><?php
            }elseif($estadoTrayecto == "En rumbo"){?>
    <p class="Titulos"><?php echo "De camino al almacen secundario de Quick Carry" ?></p><?php
}
        }elseif(isset($estadoLote) && $estadoLote == "En 2do QuickCarry"){?>
    <p class="Titulos"><?php echo "En el almacen de $destino" ?></p><?php
    }
    }elseif($estadoPaquete == "En 2do QuickCarry"){?>
    <p class="Titulos"><?php echo "El paquete esta en el almacen secundario" ?></p><?php
    }elseif($estadoPaquete == "En camioneta"){
        ?>
    <p class="Titulos"><?php echo "De camino al destino final" ?></p>
    <?php
    }elseif($estadoPaquete == "Entregado"){ ?>
    <p class="Titulos"><?php echo "Entregado con exito" ?></p>
    <?php
    }

    ?>
    </div>
    </div>
    <footer class="footer">
        <div class="container-footer">
            <div class="box">
                <h4 class="R-S">REDES SOCIALES</h4>
                <div class="redes-sociales">
                    <a href="#"><img src="../IMAGES/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="../IMAGES/instagram.png" alt="instagram"></a>
                    <a href="#"><img src="../IMAGES/twitter.png" alt="twitter"></a>
                </div>
            </div>
            <div class="box">
                <h4 class="contactanos-title">CONTACTANOS</h4>
                <div class="contactanos">
                    <p class="contactanos-correo">CORREO:</p> <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox">quickcarry830@gmail.com</a>
                    </p>
                    <p class="contactanos-tel">TEL: xxx-xxx-xxx</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
        $(document).ready(function(){
            $(".idioma-ingles").click(function(){
                $(".paquete").text("PACKAGE: ");
                $("#titulos-paquete").text("Package status:");
                $("#titulo-lote").text("lot ID: ");
                $("#titulo-estado_lote").text("Lot status: ");
                $("#titulo-vehiculo").text("Vehicle registration number: ");
                $("#titulo-conductor").text("Driver ID: ");
                $("#boton-cerrar_sesion").text("log out");
                $(".rastrear").text("TRACK PACKAGE");
                $(".R-S").text("SOCIAL NETWORKS");
                $(".contactanos-title").text("CONTACT US");
                $(".contactanos-correo").text("MAIL:");
                $(".tel").text("PHONE: xxx-xxx-xxx");
            })
            $(".idioma-espana").click(function(){
                $(".paquete").text("PAQUETE: ");
                $("#titulos-paquete").text("Estado del Paquete: ");
                $("#titulo-lote").text("ID del Lote: ");
                $("#titulo-estado_lote").text("Estado del Lote: ");
                $("#titulo-vehiculo").text("Matricula del Vehiculo: ");
                $("#titulo-conductor").text("ID del Conductor: ");
                $("#boton-cerrar_sesion").text("Cerrar sesión");
                $(".rastrear").text("RASTREAR PAQUETE");
                $(".R-S").text("REDES SOCIALES");
                $(".contactanos-title").text("CONTACTANOS");
                $(".contactanos-correo").text("CORREO:");
                $(".tel").text("TEL: xxx-xxx-xxx");
            })
        })
    </script>
</body>

</html>
