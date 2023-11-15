<?php
require("../../../db.php");
if (isset($_GET["idDesarmar"])) {
    $idLote = $_GET["idDesarmar"];

    $BuscarPertenecen = "SELECT * FROM `pertenecen` WHERE `IdLote` = '$idLote'";
    $resultadopertenecen = $conn->query($BuscarPertenecen);

    if (mysqli_num_rows($resultadopertenecen) > 0) {
        foreach ($resultadopertenecen->fetch_all(MYSQLI_ASSOC) as $filaP) {
            $paquete = $filaP["IdPaquete"];

            $actualizarPaquete = "UPDATE `paquete` SET `Estado`='En 2do QuickCarry' WHERE IdPaquete = '$paquete'";
            $resultadoActualizar = $conn->query($actualizarPaquete);

            $loteADesarmar = "DELETE FROM `pertenecen` WHERE `IdLote` = '$idLote'";
            $listaDesarmar = $conn->query($loteADesarmar);
        }
    }


    $deleteGuarda = "DELETE FROM `guarda` WHERE `IdLote` = '$idLote'";
    $resultadoGuarda = $conn->query($deleteGuarda);

    $buscaTransporta = "SELECT * FROM `transporta` WHERE `IdLote` = '$idLote'";
    $resultadoTransporta = $conn->query($buscaTransporta);

    if (mysqli_num_rows($resultadoTransporta) > 0) {
        $deleteTransporta = "DELETE FROM `transporta` WHERE `IdLote` = '$idLote'";
        $resultadoDeleteTransporta = $conn->query($deleteTransporta);
    }

    $DeleteLote = "DELETE FROM `lote` WHERE `IdLote` = '$idLote'";
    $resultadoDelete = $conn->query($DeleteLote);

    if (isset($listaDesarmar)) {
        if ($listaDesarmar == TRUE) {
            if ($DeleteLote == TRUE) {
                if (isset($resultadoActualizar)) {
                    if ($resultadoActualizar == true) {
                        if ($resultadoGuarda == true) {
                            if (isset($resultadoDeleteTransporta)) {
                                if ($resultadoDeleteTransporta == true) {
                                    header("Location: ../View/V_Lote.php");
                                } else {
                                    $menasje = "no se pudo eliminar la relacion transporta";
                                    header("Location: ../View/V_Lote.php?mensaje=$mensaje");
                                }
                            } else {
                                header("Location: ../View/V_Lote.php");
                            }
                        } else {
                            $mensaje = "No se pudo eliminar la relacion de guarda";
                            header("Location: ../View/V_Lote.php?mensaje=$mensaje");
                        }
                    } else {
                        $mensaje = "No se pudo actualizar el estado de los paquetes";
                        header("Location: ../View/V_Lote.php?mensaje=$mensaje");
                    }
                } else {
                    $mensaje = "No se pudo eliminar el lote";
                    header("Location: ../View/V_Lote.php?mensaje=$mensaje");
                }
            }
        } else {
            $mensaje = "No se pudo borrar la relacion de paquete y lote";
            header("Location: ../View/V_Lote.php?mensaje=$mensaje");
        }
    }else{
        $mensaje="Este lote no contiene paquetes, por lo tanto no puede ser desarmado.";
        header("Location: ../View/V_Lote.php?mensaje=$mensaje");
    }
}