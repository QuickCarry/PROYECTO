<?php
require("../../db.php");
if(isset($_GET["idPaquete"]) && isset($_GET["correo"])){
    $idPaquete = $_GET["idPaquete"];
    $correo = $_GET["correo"];
    $fechaYHora=date('Y-m-d H:i:s');

    $buscarCliente = "SELECT Cliente FROM `paquete` WHERE IdPaquete = '$idPaquete'";
    $resultadoCliente = $conn->query($buscarCliente);

    if(mysqli_num_rows($resultadoCliente) > 0){
        foreach ($resultadoCliente->fetch_all(MYSQLI_ASSOC) as $value) {
            $cliente = $value["Cliente"];

            $para = $cliente;
            $asunto = "Entrega del producto";
            $mensajeMail = "El producto a sido entregado con exito, la fecha y hora de la entrega: ".$fechaYHora;
            
            $headers = 'From: quickcarry830@gmail.com' . "\r\n";
            $headers.= "Reply-To: quickcarry830@gmail.com" . "\r\n";
            $headers.= "X-Mailer: PHP/" . phpversion();

            $mail_enivado = mail($para, $asunto, $mensajeMail, $headers);
        }
    }

    $consultaPaquete = "UPDATE `paquete` SET `Estado`='Entregado',`FechaRegistro`='$fechaYHora' WHERE IdPaquete = '$idPaquete'";
    $resultadoPaquete = $conn->query($consultaPaquete);

    $consultaDeleteVahacia = "DELETE FROM `vahacia` WHERE IdPaquete = '$idPaquete'";
    $resultadoDelete = $conn->query($consultaDeleteVahacia);

    if(($resultadoPaquete == true) && ($resultadoDelete == true)){
        header("Location: ../View/V_Camionero.php?correo=$correo");
    }else{
        $mensaje="Ocurrio un error al entregar el paquete";
        header("Location: ../View/V_Camioner.php?correo=$correo&mensaje=$mensaje");
    }
}