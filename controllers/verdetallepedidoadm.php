<?php

require '../fw/fw.php';
//require '../views/VerDetallePedido.php';
require '../views/VerDetallePedidoAdm.php';
require '../models/Pedido.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!isset($_GET['id'])){
	header("location: home");
	exit;
}

$p = new Pedido();

if(isset($_POST['cancelar'])){
	$p->cancelaradm($_GET['id']);
}
if(isset($_POST['despachar'])){
	$p->despachar($_GET['id']);
}

$v = new VerDetallePedidoAdm($_GET['id']);

	

$v->render();


