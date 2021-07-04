<?php

// controllers/inventario.php

require '../fw/fw.php';
require '../views/Inventario.php';
require '../models/Categoria.php';
require '../models/Producto.php';
//require '../models/Stock.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!$_SESSION['USER']['privilegio']==1){
	header("location: home");
	exit;
}

$view = new Inventario();
$p = new Producto();

$view->productos = $p->getTodosOrdenadosNombre();

//$view->categorias = new Categoria()->getTodos();

$view->render();
