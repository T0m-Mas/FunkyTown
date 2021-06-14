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
$v->render();