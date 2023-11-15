<?php
require('../../../db.php');
if((isset($_POST['id'])) && strlen($_POST['id']) > 0){
    $id = $_POST['id'];
    if(isset($_POST['cliente']) && is_string($_POST['cliente']) && strlen($_POST['cliente']) > 0){ 
        $cliente = $_POST['cliente'];
        if(isset($_POST['destino']) && is_string($_POST['destino']) && strlen($_POST['destino']) > 0){
            $destino = $_POST['destino'];
            if (isset($_POST['peso']) && is_string($_POST['peso']) && strlen($_POST['peso']) > 0){  
                $peso=$_POST['peso'];
                if(isset($_POST['tipo']) && is_string($_POST['tipo']) && strlen($_POST['tipo']) < 30 && strlen($_POST['tipo']) > 0){ 
                    $tipo = $_POST['tipo'];
                    if(isset($_POST['fecha']) && is_string($_POST['fecha']) && strlen($_POST['fecha']) > 0){ //comprueba que tiene fecha y que es un string
                        $fecha=$_POST['fecha'];
                        $idlote=$_POST['lote'];
                        $buscar_lote="SELECT * FROM `lote` WHERE IdLote = '$idlote'";
                        $sentencia=$conn->query($buscar_lote);
                        $cantidadTuplas = mysqli_num_rows($sentencia);
                        if(isset($_POST['lote']) && $cantidadTuplas > 0){
			$departamento=$_POST["departamento"];
                        $desino=$_POST["destino"];
			$ciudad=$_POST["ciudad"];
				                                
                                $array_insert_paquete=array(
                                    "id" => "$id",
                                    "destino" => "$destino",
                                    "cliente" => "$cliente",
                                    "fecha" => "$fecha",
                                    "tipo" => "$tipo",
                                    "peso" => "$peso",
				    "departamento" => "$departamento",
				    "ciudad" => "$ciudad", 
                                    "lote" => "$idlote"
                                );

                                $json_paquete = json_encode($array_insert_paquete);

                                //$url = "http://192.168.8.18:8000/PHP/APIS/ApiAlmacen/Model/M_agregarPaqueteA.php";
                                $url = "localhost/PHP/APIS/ApiAlmacen/Model/M_agregarPaqueteA.php";
                                
                                $ch = curl_init($url);

                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_paquete);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                
                                $response = curl_exec($ch);
                                curl_close($ch);
                                
                                $resultado = json_decode($response, true);
                                
				if(isset($resultado["mensaje"])){
                                	if($resultado["mensaje"] == "Funciono correctamente"){
                                    		header("Location: ../View/V_gestion_paquetes.php");
                                	}elseif($resultado["mensaje"] == "No funciono correctamente"){
                                    	$mensaje=$resultado["mensaje"];
                                    	header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
					}
				}else{
			     	    $mensaje="El destino del paquete no es el mismo que el del lote";
				    header("Location: ../View/V_agregarPaqueteA.php?mensaje=$mensaje");
				}
				
                        }else{
                        echo "No se ingreso el lote o no existe el lote asignado";
                        $mensaje = "No se ingreso un lote existente";
                        header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
                        }
                    }else{
                    echo "Datos erroneos 2";
                    $mensaje = "No se ingreso una fecha valida";
                    header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
                    }
                }else{
                echo "Datos erroneos 3";
                $mensaje = "El tipo tiene que ser text y estar entre 1 y 30 caracteres";
                header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
                }
            }else{
            echo "Datos erroneos 4";
            $mensaje = "El peso tiene que ser int";
            header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
            }
        }else{
        echo "Datos erroneos 5";
        $mensaje = "El destino tiene que ser texto";
        header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
        }
    }else{
    echo "Datos erroneos 6";
    $mensaje = "El cliente debe ser ingresado y ser texto";
    header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
    }
}else{
echo "Falto ingresar id";
$mensaje = "Falto ingresar id o el id ingresado ya existe";
header("Location: ../View/V_gestion_paquetes.php?mensaje=$mensaje");
}


?>
