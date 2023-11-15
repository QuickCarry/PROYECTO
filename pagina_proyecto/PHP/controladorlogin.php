<?php
if(isset($_POST['correo']) && isset($_POST['contrasenia'])){
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
}

session_start();

$_SESSION['usuario'] = $correo;

$datos = [
    'correo' => $correo,
    'contrasenia' => $contrasenia
];
require("db.php");

$jsonData = json_encode($datos);


//$url = "localhost/PHP/apiautenticacion.php";

$url = "http://localhost/pagina_proyecto/PHP/apiautenticacion.php";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);
var_dump($response);
echo $response;

$responseDatos = json_decode($response, true);
if ((isset($responseDatos['usuario'])) && (isset($responseDatos['cargo'])) && (isset($responseDatos['mensaje']))){

    switch (true) {
        case $responseDatos['usuario'] == true && $responseDatos['mensaje'] == "Funciono correctamente":
            if ($responseDatos['cargo'] == "Administrador"){
		echo '<script type="text/javascript">window.location.href = "../HTML/admin.php";</script>';
                //header("Location: http://192.168.8.18:8000/HTML/admin.php");
            } elseif ($responseDatos['cargo'] == "Funcionario") {
		echo '<script type="text/javascript">window.location.href = "../HTML/funcionario.php"</script>';
                //header("Location: ../HTML/funcionario.php");
            } elseif ($responseDatos['cargo'] == "Chofer") {
		$urlDireccion="Camionero/View/V_Camionero.php?correo=$correo" ?>
                <script type="text/javascript">
			window.location.href = "<?php echo $urlDireccion;?>";
		</script>
		<?php
		//header("Location: ../PHP/Camionero/View/V_Camionero.php?correo=$correo");
            }
            break;
        
        case $responseDatos['usuario'] == true && $responseDatos['mensaje'] == "Contrasena incorrecta":
            $respuesta = "contraseña incorrecta";
	    $urlDireccion="inicio-sesion.php?mensaje=$respuesta";?>
		<script type="text/javascript">
			window.location.href = "<?php echo $urlDireccion;?>";
		</script>
		<?php
            //header("Location: inicio-sesion.php?mensaje=$respuesta");
            break;
        
        case $responseDatos['usuario'] == false && $responseDatos['mensaje'] == "No existe el usuario":
            $respuesta = "No existe el usuario";
            header("Location: inicio-sesion.php?mensaje=$respuesta");
            break;
        
        default:
            break;
    }
echo "Hola";    
}
echo "Hola2";
?>
