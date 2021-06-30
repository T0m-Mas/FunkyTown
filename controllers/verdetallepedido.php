<?php

require '../fw/fw.php';
require '../views/VerDetallePedido.php';
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
	$p->cancelar($_GET['id']);
}

$v = new VerDetallePedido($_GET['id']);	

if($v->pedido['id_usuario']!=$_SESSION['USER']['id']){
	header("location: home");
	exit;
}

$v->render();
