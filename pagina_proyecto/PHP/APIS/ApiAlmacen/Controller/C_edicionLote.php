<?php
require('../../../db.php');
if(isset($_POST['id']) && isset($_POST['destino']) && isset($_POST['estado'])){
    $id = $_POST["id"]; 
    $destino = $_POST["destino"];
    $estado = $_POST["estado"];
    if (!empty($id) && !empty($destino) && !empty($estado)) {
        $array_lote=[   
            'id' => "$id",
            'destino' => "$destino",
            'estado' => "$estado"
        ];

    $json_lotes = json_encode($array_lote);
    $url = "http://localhost/pagina_proyecto/PHP/APIS/ApiAlmacen/Model/M_edicionLote.php";
    $ch = curl_init($url);                    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_lotes);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $resultado = json_decode($response, true);

    if($resultado["mensaje"] == "Se modifico correctamente"){
        header("Location: ../View/V_Lote.php");
    }
    else {
        $mensaje = "Hubo un error al modificar el lote.";
        header("Location: ../View/V_edicionLote.php?mensaje=$mensaje&id=$id");
    }  
 }else{
    // Manejar un mensaje de error si algún campo está vacío o nulo
    $mensaje = "Los campos no pueden estar vacíos o nulos.";
    header("Location: ../View/V_edicionLote.php?mensaje=$mensaje&id=$id");
}


}
?>