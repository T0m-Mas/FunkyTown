<?php

require '../fw/fw.php';
require '../views/ListadoPedidosAdm.php';
require '../models/Pedido.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if($_SESSION['USER']['privilegio']!=1){
	header("location: home");
	exit;
}

$v = new ListadoPedidosAdm();
$p = new Pedido();

if(isset($_POST['buscar'])){
	if($p->existe($_POST['id'])){
		header("location: verpedidoadm?id=".$_POST['id']);
		exit;
	}else{
		$v->alert = "No se encontro el pedido solicitado";
	}
}

if(isset($_POST['filtrar'])){
	$p = $p->getPorFiltro($_POST['nombreusuario'],$_POST['productos'],$_POST['fecha'],$_POST['limite']);
}else{
	$p = $p->getTodosAdm();
}

$v->pedidos = $p;

$v->render();

