<?php
require("../../db.php");
if (isset($_GET["id"]) && isset($_GET["destino"]) && isset($_GET["lote"]) && isset($_GET["correo"])) {
    $matricula = $_GET["id"];
    $destino = $_GET["destino"];
    $lote = $_GET["lote"];
    $correo = $_GET["correo"];
    //var_dump($_GET);
    $buscarLoteslote = "SELECT * FROM `lote` WHERE IdLote = '$lote'";
    $resultadoLoteslote = $conn->query($buscarLoteslote);
    if (mysqli_num_rows($resultadoLoteslote) > 0) {
        $actualizarEstado = "UPDATE sinergync.lote SET `EstadoLote`='Entregado' WHERE IdLote = '$lote'";
	
        $resultadoEstado = $conn->query($actualizarEstado);

        $buscarAlmacen = "SELECT * FROM `almacencarry` WHERE Departamento = '$destino'";
        $resultadoAlmacen = $conn->query($buscarAlmacen);
        if (mysqli_num_rows($resultadoAlmacen) > 0) {
            foreach ($resultadoAlmacen->fetch_all(MYSQLI_ASSOC) as $resultadoAlmacen2) {
                $idCarry = $resultadoAlmacen2["IDCarry"];
                $ruta = $resultadoAlmacen2["Ruta"];
            }

            $insertGuarda = "INSERT INTO guarda(IdLote, IDCarry, IdRuta) VALUES ('$lote','$idCarry','$ruta')";
            $resultadoGuarda = $conn->query($insertGuarda);    
        } else {
            $mensaje = "Error el almacen destino no existe";
            //header("Location: ../View/V_Camionero.php?mensaje=$mensaje");
	    echo '<script type="text/javascript">window.location.href = "../View/V_Camionero.php"';
        }

        $eliminarRelacionConLote = "DELETE FROM `transporta` WHERE IdLote='$lote'";
        $resultadoEliminar = $conn->query($eliminarRelacionConLote);
    }

    if ($resultadoEstado == true){
        if(isset($resultadoGuarda)){
            if($resultadoGuarda == true){
                if($resultadoEliminar == true){
		$ulrDireccion="../View/V_Lotes.php?usuario=$correo&matricula=$matricula";?>
		<script type="text/script">
			window.location.href = "<?php echo $urlDireccion?>";
		</script>
		<?php
                }else{
		
                    $mensaje="no se pudo eliminar la relacion de transporta";
                    header("Location: ../View/V_Lotes.php?usuario=$correo&mensaje=$mensaje&matricula=$matricula");
                }
            }else{
                $mensaje = "No se pudo insertar una tupla en guarda";
                header("Location: ../View/V_Lotes.php?usuario=$correo&mensaje=$mensaje&matricula=$matricula");
            }
        }
    }else{
        $mensaje = "No se pudo cambiar el estado del lote";
        header("Location: ../View/V_Lotes.php?usuario=$correo&mensaje=$mensaje&matricula=$matricula");
    }

}
