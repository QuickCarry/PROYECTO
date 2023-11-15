<?php
require('../../../db.php');  
if(isset($_POST['destino']) && isset($_POST['FEstimada'])){ 
    $destino = $_POST["destino"];
    $fecha = $_POST["FEstimada"];
    if (!empty($destino)) {
        $array_lote=[   
            'destino' => "$destino",
	    'fecha' => "$fecha"
        ];
    $json_lotes = json_encode($array_lote);
    $url = "http://localhost/pagina_proyecto/PHP/APIS/ApiAlmacen/Model/M_agregarLotes.php";
    $ch = curl_init($url);                    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_lotes);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $resultado2 = json_decode($response, true);

    if($resultado2["mensaje"] == "Se agrego correctamente"){
        header("Location: ../View/V_Lote.php");
    }elseif($resultado2["mensaje"] == "No existe el almacen"){
        $mensaje = "No existe el almacen";
        header("Location: ../View/V_agregarLotes.php?mensaje=$mensaje");
    }else{
        $mensaje = "Hubo un error al agregar un lote.";
        header("Location: ../View/V_agregarLotes.php?mensaje=$mensaje");
    }
}else{
    // Manejar un mensaje de error si algún campo está vacío o nulo
    $mensaje = "Los campos no pueden estar vacíos o nulos.";
    header("Location: ../View/V_agregarLotes.php?mensaje=$mensaje&id=$id");
}
}
?>
