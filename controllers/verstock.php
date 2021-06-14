<?php

// controllers/verstock.php

require '../fw/fw.php';
require '../views/VerStock.php';
require '../models/Stock.php';
require '../models/Producto.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!$_SESSION['USER']['privilegio']==1){
	header("location: home");
	exit;
}
if(!isset($_GET['id'])){
	header("location: home");
	exit;
}

$p = new Producto();
$s = new Stock();

$view = new VerStock();

if(isset($_POST['stock='])){
	$s->setStock($_GET['id'],$_POST['talle'],$_POST['nuevostock']);
}
if(isset($_POST['stock+'])){
	$s->setStockSumar($_GET['id'],$_POST['talle'],$_POST['nuevostock']);
}
if(isset($_POST['stock-'])){

	if($s->setStockRestar($_GET['id'],$_POST['talle'],$_POST['nuevostock'])==1){
		$view->error = "La cantidad no puede quedar negativa";
	}
}

$view->producto = $p->getID($_GET['id']);
$view->stock = $s->getID($_GET['id']);



$view->render();