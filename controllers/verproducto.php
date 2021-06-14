<?php

// controllers/verproducto

require '../fw/fw.php';
require '../views/VerProducto.php';
require '../models/Producto.php';
require '../models/Pedido.php';
require '../models/Stock.php';

if(!isset($_GET["id"])){
	header("location: home");
	exit;
}

if(isset($_POST['agregar'])){

	if($_SESSION['logeado']==false){
		header("location: ../login");
		exit;
	}

	if(!isset($_SESSION['carrito'])){
		$p = new Pedido();
		$p->agregar($_GET['id'],$_POST['talle'],$_POST['cantidad']);
		$_SESSION['carrito'] = serialize($p);
	}else{
		$p = unserialize($_SESSION['carrito']);
		$p->agregar($_GET['id'],$_POST['talle'],$_POST['cantidad']);
		$_SESSION['carrito'] = serialize($p);
	}

}

$view = new VerProducto($_GET["id"]);
$view->render();
