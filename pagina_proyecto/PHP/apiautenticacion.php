<?php 
require('db.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);

    $correo = $data['correo'];
    $contrasenia = $data['contrasenia'];
    
    $insertar = "SELECT correo, cargo, contraseña FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($insertar);
    
    if($resultado && mysqli_num_rows($resultado) > 0){
        foreach($resultado->fetch_all(MYSQLI_ASSOC) as $fila){    
            if(($fila['correo'] == $correo) && ($fila['contraseña'] == $contrasenia)){
                $response = array(
                    "usuario" => true,
                    "cargo" => $fila['cargo'],
                    "mensaje" => 'Funciono correctamente',
                    "correo" => $fila['correo']
                );
            }else if(($fila['correo'] === $correo) && (!($fila['contraseña'] === $contrasenia))){
                $response = array(
                    "usuario" => true,
                    "cargo" => $fila['cargo'],
                    "mensaje" => 'Contrasena incorrecta',
                    "correo" => $correo
                );
            }
            else if(!($fila['correo'] === $correo) && (!($fila['contraseña'] === $contrasenia))){
                $response = array(
                    "usuario" => false,
                    "cargo" => "si",
                    "mensaje" => 'No existe el usuario',
                    "correo" => $fila['correo']
                );
            }
        }
    }elseif(mysqli_num_rows($resultado) == 0){
        $buscarchofer = "SELECT correo, cargo, contraseña FROM chofer WHERE correo = '$correo'";
        $resultadochofer = $conn->query($buscarchofer);
        if(mysqli_num_rows($resultadochofer) > 0){
            foreach($resultadochofer->fetch_all(MYSQLI_ASSOC) as $fila2){
                if(($fila2["correo"] == $correo) && ($fila2["contraseña"] == $contrasenia)){
                    $response = array(
                        "usuario" => true,
                        "cargo" => $fila2['cargo'],
                        "mensaje" => 'Funciono correctamente',
                        "correo" => $fila2['correo']
                    );
                }elseif(($fila2['correo'] == $correo) && (!($fila2['contraseña'] == $contrasenia))){
                    $response = array(
                        "usuario" => true,
                        "cargo" => $fila2['cargo'],
                        "mensaje" => 'Contrasena incorrecta',
                        "correo" => $correo
                    );
                }
            }
        }else{
            $response = array(
                "usuario" => false,
                "mensaje" => 'No existe el usuario',    
                "cargo" => 0
            );
        }
    }
    header('Content-type application/json');
    header('Access-Control-Allow-Origin: *');

    echo $jsonResponse = json_encode($response);
}
?>
