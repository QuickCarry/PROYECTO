<?php
if(isset($_POST['correo']) && isset($_POST['contrasenia'])){
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
}

$datos = [
    'correo' => $correo,
    'contrasenia' => $contrasenia
];

$jsonData = json_encode($datos);

$url = "http://localhost/pagina_proyecto/PHP/apiautenticacion.php";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

echo $response;

if (curl_errno($ch)){
    echo 'Error al enviar la solicitud: '. curl_error($ch);
}
$responseDatos = json_decode($response, true);
if ((isset($responseDatos['usuario'])) && (isset($responseDatos['cargo'])) && (isset($responseDatos['mensaje']))){
    switch (true) {
        case $responseDatos['usuario'] === true && $responseDatos['mensaje'] === "Funciono correctamente":
            if ($responseDatos['cargo'] === "Administrador") {
                header("Location: ../HTML/admin.html");
            } elseif ($responseDatos['cargo'] === "Funcionario") {
                header("Location: ../HTML/funcionario.html");
            } elseif ($responseDatos['cargo'] === "Empresa") {
                header("Location: ../PHP/empresa.php");
            }
            break;
        
        case $responseDatos['usuario'] === true && $responseDatos['mensaje'] === "Contrasena incorrecta":
            $respuesta = "contraseña incorrecta";
            header("Location: inicio-sesion.php?mensaje=$respuesta");
            break;
        
        case $responseDatos['usuario'] === false && $responseDatos['mensaje'] === "No existe el usuario":
            $respuesta = "No existe el usuario";
            header("Location: inicio-sesion.php?mensaje=$respuesta");
            break;
        
        default:
            break;
    }
    
}

?>