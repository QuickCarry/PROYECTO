<?php
require('../../../db.php');
    if(isset($_POST['id'])){ //comprueba que contiene el id

        if (isset($_POST['peso']) && is_string($_POST['peso'])){ //comprueba que contiene el peso y que es de tipo string

            if(isset($_POST['tipo']) && is_string($_POST['tipo']) && strlen($_POST['tipo']) < 30 && strlen($_POST['tipo']) > 0){ //comprueba que contiene el tipo, que es de tipo string y que tiene una longitud menor a 30 y mayor a 0

                if(isset($_POST['cliente']) && is_string($_POST['cliente'])) { //comprueba que tiene el cliente y que es de tipo string

                    if(isset($_POST['ubicacion']) && is_string($_POST['ubicacion'])) { //comprueba que tiene ubicacion y que es de tipo string

                        if(isset($_POST['fecha']) && is_string($_POST['fecha'])) { //comprueba que tiene fechaRegistro y que es un string

                                if(isset($_POST['lote']) && is_string($_POST['lote'])){
                                $idPaquete = $_POST["id"];
                                $destino = $_POST["ubicacion"];
                                $cliente = $_POST["cliente"];
                                $fecha = $_POST["fecha"];
                                $tipo = $_POST["tipo"];
                                $peso = $_POST["peso"];
                                //$estado = $_POST["estado"];
                                $lote = $_POST["lote"];

                                $array_paquete=array(
                                    "id" => "$idPaquete",
                                    "destino" => "$destino",
                                    "cliente" => "$cliente",
                                    "fecha" => "$fecha",
                                    "tipo" => "$tipo",
                                    "peso" => "$peso",
                                    "lote" => "$lote"
                                );
                                //var_dump($array_paquete);   
                                $json_paquete = json_encode($array_paquete);
                                $url = "http://localhost/pagina_proyecto/PHP/APIS/ApiAlmacen/Model/M_edicionPaqueteF.php";
                                $ch = curl_init($url);
                                
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_paquete);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($ch);
                                curl_close($ch);
                                $resultado = json_decode($response, true);
                                //var_dump($response);
                                if($resultado["mensaje"] == "Funciono correctamente"){
                                    header("Location: ../View/V_paquetesF.php");
                                }
                            }
                            
                        }else{
                            echo "Faltaron datos b ";
                        }
                    }else{
                        echo "Faltaron datos c";
                    }
                }else{
                    echo "Faltaron datos d";
                }
            }else{
                echo "Se entregaron datos erroneos";
            }
        }else{
            echo "Faltaron datos f";
        }
    }else{
        echo "Faltaron datos f";
    } 

       
?>