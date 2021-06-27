<?php

require '../fw/fw.php';
require '../views/Carrito.php';
require '../models/Producto.php';
require '../models/Pedido.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}

$v = new Carrito();

if(isset($_POST['quitar'])){
	if($v->carrito->quitar($_POST['key'])){ //si retorna true hay que eliminar el chango
		$v->carrito = false;
		unset($_SESSION['carrito']);
	}else{
		$_SESSION['carrito'] = serialize($v->carrito);
	}
}
if(isset($_POST['confirmar'])){
	$v->carrito->enviar($_SESSION['USER']['id']);
	unset($_SESSION['carrito']);
	header("location: pedidoOk");
	exit;
}

$v->render();