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

$view = new VerProducto($_GET["id"]);

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
		$p->wakeup();//la instancia se pierde al serializar y deserializar
		$res = $p->agregar($_GET['id'],$_POST['talle'],$_POST['cantidad']);
		if($res == 1){
			$view->error = "No hay suficiente stock para agregar al carrito";
		}
		//var_dump($p);
		$_SESSION['carrito'] = serialize($p);
	}

	header("location: ../carrito");
	exit();

}

$view->render();
