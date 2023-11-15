<?php
require("../../db.php");
session_start();
error_reporting(0);
$varsession = $_SESSION["usuario"];
$consulta = "SELECT cargo FROM `usuarios` WHERE correo='$varsession'";
$lista = $conn->query($consulta);
foreach ($lista->fetch_all(MYSQLI_ASSOC) as $fila) {
    $cargo = $fila["cargo"];
}

if (($varsession == NULL || $varsession == '') || ($cargo !== "Chofer")) {
    header("Location: ../../inicio-sesion.php?user=$varsession");
    die(); // Detén la ejecución del script actual   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../STYLES/camionero.css">
    <link rel="icon" type="image/x-icon" href="../../../IMAGES/LOGO_ICONO.ico">
    <title>Camionero</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../../../IMAGES/LOGO_SISTEMA.png" alt=""></a>
        </div>
        <nav class="menu">
            <a href="#"><img src="../../../IMAGES/espana.png" alt="" class="idioma"></a>

            <a href="#"><img src="../../../IMAGES/estados-unidos.png" alt="" class="idioma"></a>
        </nav>
    </header>
    <div class="table-container">
        <div class="table-header">
            <div class="table-cell H">Camionero</div>
            <div class="table-cell H">Nombre</div>
            <div class="table-cell H">Matricula</div>
            <div class="table-cell H">Estado</div>
            <div class="table-cell H">Cambiar estado</div>
            <!-- <div class="table-cell H">Cambiar estado</div>
            <div class="table-cell H">Lote | Destino</div> -->
            
            <?php
            require("../../db.php");
            $correo = $_GET["correo"];
            $sentenciachofer = "SELECT * FROM `chofer` WHERE correo = '$correo'";
            $filas = $conn->query($sentenciachofer);
            foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
                $id = $fila['Ci'];
                ?>
                <div class="table-cell V">Camionero</div>
                <div class="table-cell"><?php echo $id; ?></div>
                <div class="table-cell V">Nombre</div>
                <div class="table-cell"><?php echo $fila["NombreCompleto"]; ?></div>
                <?php
                $sentenciavehiculo = "SELECT * FROM `conduce` WHERE Ci = '$id'";
                $filasvehiculo = $conn->query($sentenciavehiculo);
                foreach ($filasvehiculo->fetch_all(MYSQLI_ASSOC) as $filavehiculo) {
                    $matricula = $filavehiculo["Matricula"];
                    $estadoTrayecto = $filavehiculo["Estado"];

                    $buscarCamion = "SELECT * FROM `camion` WHERE Matricula = '$matricula'";
                    $resultadoCamion = $conn->query($buscarCamion);

                    if (mysqli_num_rows($resultadoCamion) == 1) {
                        ?>
                        <div class="table-cell V">Matricula</div>
                        <div class="table-cell"><?php echo $matricula; ?></div>
                        <?php
                        if (($estadoTrayecto == "En central")) {
                            
                            ?>
                            <div class="table-cell V">Estado</div>
                            <div class="table-cell"><?php echo $estadoTrayecto;?></div>
                            <div class="table-cell V">Cambiar estado</div>
                            <div class="table-cell">
                            <a
                                href="../Controller/C_empezarTrayecto.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><span 
                                style="Color: black;"> <p class="Estado">Empezar camino</p></span>
                            </a>
                            </div>
                            <?php
                        } elseif ($estadoTrayecto == "En rumbo") {
                            ?>
                                <div class="table-cell V">Cambiar estado</div>
                                <div class="table-cell"><?php echo $filavehiculo["Estado"];?></div>
                                <?php 

                                $sentencialotes = "SELECT * FROM `transporta` WHERE Matricula = '$matricula'";
                                $filaslotes = $conn->query($sentencialotes);
                                if (mysqli_num_rows($filaslotes) > 0) {?>
                                <div class="table-cell">
                                <a href="V_Lotes.php?usuario=<?php echo $correo?>&matricula=<?php echo $matricula?>"><p class="Estado">Ver lotes</p></a>
                                </div>
                                <?php
                                }else{
                                ?>
                                    <div class="table-cell">
                                    <a href="../Controller/C_ponerVuelta.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><p class="Estado">Volver a QuickCarry</p></a>
                                </div>
                                <?php
                                }
                            }elseif($estadoTrayecto != "En central"){?>
                            <div class="table-cell V">Estado</div>
                            <div class="table-cell"><?php echo $filavehiculo["Estado"];?></div>

                                <div class="table-cell">
                                    <a href="../Controller/C_ponerVuelta.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><p class="Estado">Volver a QuickCarry</p></a>
                                </div>
                                <?php
                            }
                    } elseif (mysqli_num_rows($resultadoCamion) == 0) {

                        $buscarCamioneta = "SELECT * FROM `camioneta` WHERE Matricula = '$matricula'";
                        $resultadoCamioneta = $conn->query($buscarCamioneta);
                        if (mysqli_num_rows($resultadoCamioneta) == 1) {?>
                            <div class="table-cell V">Matricula</div>
                        <div class="table-cell"><?php echo $matricula; ?></div>
                        <?php
                        if (($estadoTrayecto == "En 2do QuickCarry")) {
                            
                            ?>
                            <div class="table-cell V">Estado</div>
                            <div class="table-cell"><?php echo $filavehiculo["Estado"];?></div>
                            <div class="table-cell V">Cambiar estado</div>
                            <div class="table-cell">
                            <a
                                href="../Controller/C_empezarTrayecto.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><span 
                                style="Color: black;"> <p class="Estado">Empezar camino</p></span>
                            </a>
                            </div>
                            <?php
                        } elseif ($estadoTrayecto == "En rumbo") {
                            ?>
                                <div class="table-cell V">Cambiar estado</div>
                                <div class="table-cell"><?php echo $filavehiculo["Estado"];?></div>
                                <?php 

                                $sentenciaPaquetes = "SELECT * FROM `vahacia` WHERE Matricula = '$matricula'";
                                $filasPaquetes = $conn->query($sentenciaPaquetes);
                                if (mysqli_num_rows($filasPaquetes) > 0) {?>
                                <a href="V_paquetes.php?usuario=<?php echo $correo?>&matricula=<?php echo $matricula?>"><p class="Estado">Ver paquetes</p></a>
                                <?php
                                }else{
                                ?>
                                    <div class="table-cell">
                                    <a href="../Controller/C_Volver2.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><p class="Estado">Volver a 2do QuickCarry</p></a>
                                </div>
                                <?php
                                }
                            }elseif($estadoTrayecto != "En 2do QuickCarry"){?>
                            <div class="table-cell V">Estado</div>
                            <div class="table-cell"><?php echo $filavehiculo["Estado"];?></div>

                                <div class="table-cell">
                                    <a href="../Controller/C_ponerVuelta.php?id=<?php echo $matricula ?>&correo=<?php echo $correo ?>"><p class="Estado">Volver a QuickCarry</p></a>
                                </div>

                                <?php
                            }

                        }
                    }
                }
            }
            if (isset($_GET["mensaje"])) {
                $mensaje = $_GET["mensaje"];
                echo $mensaje;
            }

            ?>
        </div>
    </div>
    <div class="botones-container">
        <a href="../../cerrar_session.php" class="boton">Cerrar Sesion</a>
    </div>
</body>

</html>

<?php

if (isset($_GET["mensaje"])) {
    echo $_GET["mensaje"];
}
