<?php 

class paquete{

    public function get($id){
            require('db.php');
            $sentenciaGET="SELECT * FROM paquete WHERE IdPaquete = '$id'";
            $insertar=$conn->query($sentenciaGET);
            foreach($insertar->fetch_all(MYSQLI_ASSOC) as $insertado){ 
                echo $insertado['IdPaquete'];
                echo $insertado['Peso'];
                echo $insertado['Tipo'];
                echo $insertado['Cliente'];
                echo $insertado['Ubicacion'];
                echo $insertado['FechaRegistro'];
                echo $insertado['Estado'];
            }
    }

    public function post($destino, $cliente, $fecha, $loteAsig, $peso, $tipo, $estado){
        require('db.php');
        
        $sentenciaPOST="INSERT INTO paquete(Peso, Tipo, Cliente, Ubicacion, FechaRegistro, Estado) VALUES ('$peso','$tipo','$cliente','$destino','$fecha','$estado')";
        $lista=$conn->query($sentenciaPOST);
        if($lista){
            echo "ingresado con exito";
        }else{
            echo "Ha ocurrido un error al ingresar";
        }
    }

    public function put($idPaquete, $destino, $cliente, $fecha, $estado, $peso, $tipo){
        require('db.php');   
        
        $sentenciaPUT="UPDATE `paquete` SET `Ubicacion`='$destino', `Cliente`='$cliente', `FechaRegistro`='$fecha', `Estado`='$estado', `Tipo`='$tipo', `Peso`='$peso'  WHERE `idPaquete` = '$idPaquete'";
        $listaPUT=$conn->query($sentenciaPUT);
        if($listaPUT){
            echo "modificacion cumplida con exito";
        }else{
            echo "Ha ocurrido un error al modificar";
        }
    }

    public function delete($id){
    require('db.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos
        $sentenciaDELETE = "DELETE FROM `paquete` WHERE idPaquete = '$id'";
        $listaDELETE = $conn->query($sentenciaDELETE);
        if ($listaDELETE){
            echo "Paquete eliminado con éxito";
            header("Location: gestion_paquetes.php");
        } else {
            echo "Ocurrió un error al eliminar el paquete";
            echo "<script>alert('No se pudo eliminar');</script>";
        }
        
    }
}
class lote{
    public function post($destino, $estado){
        require('db.php');
        
        $sentenciaPOST="INSERT INTO lote(DestinoLote, EstadoLote) VALUES ('$destino','$estado')";
        $lista=$conn->query($sentenciaPOST);
        if($lista){
            echo "ingresado con exito";
        }else{
            echo "Ha ocurrido un error al ingresar";
        }

        
    }
    public function get($id){
        require('db.php');
        $sentenciaGET="SELECT * FROM lote WHERE IdLote = '$id'";
        $ConsultaloteGet=$conn->query($sentenciaGET);

        foreach($ConsultaloteGet->fetch_all(MYSQLI_ASSOC) as $lista){ 
            echo $lista['IdLote'];
            echo $lista['EstadoLote'];
            echo $lista['DestinoLote'];
        }
    }

    public function delete($id){
        require('db.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos
            $sentenciaDELETE = "DELETE FROM `lote` WHERE IdLote = '$id'";
            $listaDELETE = $conn->query($sentenciaDELETE);
            if ($listaDELETE){
                echo "Lote eliminado con éxito";
                header("Location: ver_lote.php");
            } else {
                echo "Ocurrió un error al eliminar el lote";
                echo "<script>alert('No se pudo eliminar');</script>";
        }       
    }
    
    public function put($idLote,$destino, $estado){
        require('db.php');   
        
        $sentenciaPUT="UPDATE `lote` SET `DestinoLote`='$destino', `EstadoLote`='$estado' WHERE `IdLote` = '$idLote'";
        $listaPUT=$conn->query($sentenciaPUT);
        if($listaPUT){
            echo "modificacion cumplida con exito";
        }else{
            echo "Ha ocurrido un error al modificar";
        }
    }
}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE"); // Solo necesitas permitir el método DELETE
header("Content-Type: application/json; charset=UTF-8");
$method = $_SERVER['REQUEST_METHOD'];
if($method == true){
switch($method){
    case 'GET':
        $tipo = $_GET['tipo'];
        if($tipo == 'paquete'){
            $id=$_GET['idPaquete'];
            $paquete=new paquete();
            $paquete->get($id);
        }elseif($tipo == 'lote'){
            $lote=new lote();
            $lote->get($_GET['idlote']);
        }
        break;

    case 'POST':
        if($_GET['tipo'] == 'paquete'){
            $destino = $_GET['destino'];
            $cliente = $_GET['cliente'];
            $fecha = $_GET['fecha'];
            $loteAsig = $_GET['lote'];
            $peso = $_GET['peso'];
            $estado = $_GET['estado'];
            $tipo = $_GET['tipopaquete'];

            $paquetePOST=new paquete();
            $paquetePOST->post($destino, $cliente, $fecha, $loteAsig, $estado, $peso, $tipo);
        }else if($_GET['tipo'] == 'lote'){
            $loteGet=new lote();
            $loteGet->post($_GET['destino'], $_GET['estado']);
            
        }
        break;

    case 'PUT':
        if($_GET['tipo'] == 'paquete'){
            $paquetePut=new paquete();
            $paquetePut->put($_GET['idPaquete'], $_GET['destino'], $_GET['cliente'], $_GET['fecha'], $_GET['estado'], $_GET['peso'], $_GET['tipopaquete'] );
        }elseif($_GET['tipo'] == 'lote'){
            $lotePut=new lote();
            $lotePut->put($_GET['idlote'], $_GET['destino'], $_GET['estado']);
        }
        break;

    case 'DELETE':
        if($_GET['tipo'] == 'paquete'){
            $paquete=new paquete();
            $paquete->delete($_GET['idPaquete']);
        }elseif($_GET['tipo'] == 'lote'){
            $loteDelete=new lote();
            $loteDelete->delete($_GET['idlote']);
        }
        
        break;
        }
    }
    

?>