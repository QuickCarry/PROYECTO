<?php
require("../../db.php");
if(isset($_GET["usuario"]) && isset($_GET["matricula"])){
    $correo=$_GET["usuario"];
    $matricula=$_GET["matricula"];

    $sentenciaPaquetes = "SELECT * FROM `vahacia` WHERE Matricula = '$matricula'";
    $resultadoPaquete= $conn->query($sentenciaPaquetes);

    if(mysqli_num_rows($resultadoPaquete) > 0){
        foreach($resultadoPaquete->fetch_all(MYSQLI_ASSOC) as $row){
            $paquete=$row["IdPaquete"];
            
            $buscaEnpaquete="SELECT * FROM `paquete` WHERE IdPaquete = '$paquete'";
            $resultadoBusca=$conn->query($buscaEnpaquete);

            if(mysqli_num_rows($resultadoBusca) > 0){
            $destinoLote="SELECT Ubicacion FROM `paquete` WHERE IdPaquete = '$paquete'";
            $resultadoDestino = $conn->query($destinoLote);

            foreach ($resultadoDestino->fetch_all(MYSQLI_ASSOC) as $value) {
                $destino = $value["Ubicacion"];

                ?> <h2> <?php echo "Paquete: ". $paquete . " | " . "Destino: " . $destino ?></h2>
                <a href="../Controller/C_ponerEntrega.php?id=<?php echo $matricula?>&destino=<?php echo $destino ?>&paquete=<?php echo $paquete ?>
                &correo=<?php echo $correo?>"><p class="Estado"><button>Dejar paquete en almacen</button></p></a>
                <?php
            }
            }
        }
    }

    ?>
    <a href="V_Camionero.php?correo=<?php echo $correo?>"><button>Volver a camionero</button></a>
    <?php
    if(isset($_GET["mensaje"])){
        echo $_GET["mensaje"];
    }
}