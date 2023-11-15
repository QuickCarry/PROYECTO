<?php
require("../../db.php");
echo $_GET["id"];
echo $_GET["destino"];
echo $_GET["paquete"];
echo $_GET["correo"];
if (isset($_GET["id"]) && isset($_GET["destino"]) && isset($_GET["paquete"]) && isset($_GET["correo"])) {
    
    $matricula = $_GET["id"];
    $destino = $_GET["destino"];
    $paquete = $_GET["paquete"];
    $correo = $_GET["correo"];

    $buscarPaquete = "SELECT * FROM `paquete` WHERE IdPaquete = '$paquete'";
    $resultadoPaquete = $conn->query($buscarPaquete);
    echo "hola";
    if (mysqli_num_rows($resultadoPaquete) > 0) {
        $actualizarEstado = "UPDATE `paquete` SET `Ubicacion`='Entregado' WHERE IdPaquete = '$paquete'";
        $resultadoEstado = $conn->query($actualizarEstado);
        echo "Hola";
        $eliminarRelacionConPaquete = "DELETE FROM `vahacia` WHERE IdPaquete='$paquete'";
        $resultadoEliminar = $conn->query($eliminarRelacionConPaquete);
    }else{
        $mensaje="No existe el paquete";
        header("Location: ../View/V_paquetes.php?usuario=$correo&matricula=$matricula&mensaje=$mensaje");
    }

    if(isset($resultadoEstado)){
        if($resultadoEstado == true){
            if($resultadoEliminar == true){
                header("Location: ../View/V_paquetes.php?usuario=$correo&matricula=$matricula");
            }else{
                $mensaje="Ocurrio algo mal";
                header("Location: ../View/V_paquetes.php?usuario=$correo&matricula=$matricula&mensaje=$mensaje");
            }
        }else{
            $mensaje="Ocurrio algo mal";
            header("Location: ../View/V_paquetes.php?usuario=$correo&matricula=$matricula&mensaje=$mensaje");
        }
    }else{
        $mensaje="Ocurrio algo mal";
        header("Location: ../View/V_paquetes.php?usuario=$correo&matricula=$matricula&mensaje=$mensaje");
    }
}