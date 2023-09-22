<?php 
require('db.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);

    $correo = $data['correo'];
    $contrasenia = $data['contrasenia'];
    
    $insertar = "SELECT correo, cargo, contraseña FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($insertar);

    if($resultado && $resultado->num_rows > 0){
        $filas = $resultado->fetch_all(MYSQLI_ASSOC);
        foreach($filas as $fila){
            if(($fila['correo'] === $correo) && ($fila['contraseña'] === $contrasenia)){
                $response = array(
                    "usuario" => true,
                    "cargo" => $fila['cargo'],
                    "mensaje" => 'Funciono correctamente'
                );

            }else if(($fila['correo'] === $correo) && (!($fila['contraseña'] === $contrasenia))){
                $response = array(
                    "usuario" => true,
                    "cargo" => $fila['cargo'],
                    "mensaje" => 'Contrasena incorrecta'
                );
            }
            else if(!($fila['correo'] === $correo) && (!($fila['contraseña'] === $contrasenia))){
                $response = array(
                    "usuario" => false,
                    "cargo" => "si",
                    "mensaje" => 'No existe el usuario'
                );
            }
            }
    }else{
        $response = array(
            "usuario" => false,
            "cargo" => "si",
            "mensaje" => 'No existe el usuario'
        );
    }
    header('Content-type application/json');
    header('Access-Control-Allow-Origin: *');

    echo $jsonResponse = json_encode($response);
}
?>