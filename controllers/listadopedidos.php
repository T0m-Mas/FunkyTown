<?php

require '../fw/fw.php';
require '../models/Pedido.php';
require '../views/ListadoPedidos.php';

if(!isset($_GET['id'])){
	header("location: home");
	exit;
}
if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}

$view = new ListadoPedidos($_GET['id']);
$view->render();