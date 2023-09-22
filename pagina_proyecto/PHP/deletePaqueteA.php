<?php
require('db.php');
if(isset($_GET['id'])){


require('../PHP/apiAlmacen.php');
$paquete=new paquete;
$paquete->delete($_GET['id']);
}
?>
