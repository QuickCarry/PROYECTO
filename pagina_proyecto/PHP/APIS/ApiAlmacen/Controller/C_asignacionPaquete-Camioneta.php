<?php
if((isset($_POST["paquete"]) && !empty($_POST["paquete"])) && (isset($_POST["matricula"]) && !empty($_POST["matricula"]))){
    $paquete = $_POST["paquete"];
    $matricula = $_POST["matricula"];

    $array_insert_paquete=array(
        "matricula" => "$matricula",
        "paquete" => "$paquete"
    );

    $json_paquete = json_encode($array_insert_paquete);

    $url = "http://localhost/pagina_proyecto/PHP/APIS/ApiAlmacen/Model/M_asignacionPaquete-Camioneta.php";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_paquete);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);
    $resultado = json_decode($response, true);

    if($resultado["mensaje"] == "Funciono correctamente"){
        header("Location: ../View/V_agregarPaqueteCamioneta.php");
    }elseif($resultado["mensaje"] == "No funciono correctamente"){
        $mensaje = "No funciono";
        header("Location: ../View/V_asignarPaqueteCamioneta.php?mensaje=$mensaje");
    }
}elseif(empty($_POST["paquete"]) || empty($_POST["matricula"])){
    $mensaje="Requiere el paquete y la matricula del camion";
    header("Location: ../View/V_asignarPaqueteCamioneta.php?mensaje=$mensaje");
}