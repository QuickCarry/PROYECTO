<?php
require('db.php');
require('../PHP/apiAlmacen.php');

$lote = new lote;
$lote->delete($_GET['id']);
?>