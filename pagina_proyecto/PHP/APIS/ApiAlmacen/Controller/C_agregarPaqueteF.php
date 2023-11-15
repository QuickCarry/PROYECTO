<?php
require('../../../db.php');
if((isset($_POST['id'])) && strlen($_POST['id']) > 0){
    $id = $_POST['id'];
    if(isset($_POST['cliente']) && is_string($_POST['cliente']) && strlen($_POST['cliente']) > 0){ //comprueba que tiene el cliente y que es de tipo string
        $cliente = $_POST['cliente'];
        if(isset($_POST['destino']) && is_string($_POST['destino']) && strlen($_POST['destino']) > 0){ //comprueba que tiene ubicacion y que es de tipo string
            $destino = $_POST['destino'];
            if (isset($_POST['peso']) && is_string($_POST['peso']) && strlen($_POST['peso']) > 0){  //comprueba que contiene el peso y que es de tipo string
                $peso=$_POST['peso'];
                if(isset($_POST['tipo']) && is_string($_POST['tipo']) && strlen($_POST['tipo']) < 30 && strlen($_POST['tipo']) > 0){ //comprueba que contiene el tipo, que es de tipo string y que tiene una longitud menor a 30 y mayor a 0
                    $tipo = $_POST['tipo'];
                        $idlote=$_POST['lote'];
                        $buscar_lote="SELECT * FROM `lote` WHERE IdLote = '$idlote'";
                        $sentencia=$conn->query($buscar_lote);
                        if(isset($_POST['lote']) && mysqli_num_rows($sentencia) > 0){ //comprueba que se ingreso un lote y que es de tipo string
                                $departamento=$_POST['departamento'];
				                $ciudad=$_POST['ciudad'];

                                $array_insert_paquete=array(
                                    "id" => "$id",
                                    "destino" => "$destino",
                                    "cliente" => "$cliente",
                                    "tipo" => "$tipo",
                                    "peso" => "$peso",
				                    "Destino" => "$destino",
				                    "ciudad" => "$ciudad",
				                    "departamento" => "$departamento",
                                    "lote" => "$idlote"
                                );

                                $json_paquete = json_encode($array_insert_paquete);

                                $url = "http://localhost/pagina_proyecto/PHP/APIS/ApiAlmacen/Model/M_agregarPaqueteF.php";
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_paquete);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                
                                $response = curl_exec($ch);
                                curl_close($ch);
                                var_dump($response);
				
                                $resultado = json_decode($response, true);
				
                                $mensajePa = $resultado["mensajePaquetes"];
                                $mensajePe = $resultado["mensajePertenecen"];
               			echo $mensajePa;
				echo $mensajePe; 
				//echo $resultado;
                                if($mensajePa == "Ya existe este id, no se puede registrar"){
                                    $mensaje = "Ya existe este id, no se puede registrar";
				    $urlDireccion="../View/V_agregarPaqueteF.php?mensaje=$mensaje"; ?>
				    <script type="text/javascript">
					window.location.href = "<?php echo $urlDireccion; ?>";

				    </script>
				<?php
                                }else{
                                if($mensajePa == "Paquete agregado con exito en paquetes"){
                                    if($mensajePe == "Paquete agregado con exito en pertenecen"){
                                        //header("Location: ../View/V_paquetesF.php");
					echo '<script type="text/javascript">window.location.href = "../View/V_paquetesF.php";</script>';
                                    }elseif($mensajePe == "El paquete no pudo ser ingresado en pertenecen"){
                                        $mensaje = "No se pudo agregar el paquete en pertenecen";
                                        header("Location: ../View/V_agregarPaqueteF.php?mensaje=$mensaje");
                                    }
                                }elseif($mensajePa == "El paquete no pudo ser agregado en paquetes"){
                                    $mensaje = "El paquete no pudo ser agregado en paquete";
                                    header("Location: ../View/V_agregarPaquetesF.php?mensaje=$mensaje");
                                }elseif($mensajePe == "El destino del paquete no pertenece al destino del lote"){
				    $mensaje = "El destino del paquete no es el mismo que el destino del lote";
				    $urlDireccion="../View/V_agregarPaqueteF.php?mensaje=$mensaje";?>
				    <script type="text/javascript"> 
					window.location.href = "<?php echo $urlDireccion; ?>";
				    </script>	
				<?php
				}
                            }
                        }else{
                        echo "No se ingreso el lote o no existe el lote asignado";
                        $mensaje = "No se ingreso un lote existente";
                        header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
                        }   
                }else{
                echo "Datos erroneos 3";
                $mensaje = "El tipo tiene que ser text y estar entre 1 y 30 caracteres";
                header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
                }
            }else{
            echo "Datos erroneos 4";
            $mensaje = "El peso tiene que ser int";
            header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
            }
        }else{
        echo "Datos erroneos 5";
        $mensaje = "El destino tiene que ser texto";
        header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
        }
    }else{
    echo "Datos erroneos 6";
    $mensaje = "El cliente debe ser ingresado y ser texto";
    header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
    }
}else{
echo "Falto ingresar id";
$mensaje = "Falto ingresar id o el id ingresado ya existe";
header("Location: ../View/V_paquetesF.php?mensaje=$mensaje");
}


?>
