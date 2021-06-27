<?php
//controllers/listadoprincipal.php

require '../fw/fw.php';
require '../views/ListadoPrincipal.php';
require '../models/Producto.php';
require '../models/Categoria.php';

$productos = new Producto();
$categorias = new Categoria();
$vlista = new ListadoPrincipal();
$vlista->categorias = $categorias->getTodos();

if(isset($_GET['categoria'])){
	$vlista->productos = $productos->getCategoria($_GET['categoria']);
}else{
	$vlista->productos = $productos->getTodos();
}

if(isset($_GET['buscar'])){
	$vlista->productos = $productos->getTitulo($_GET['buscador']);
}else{
	$vlista->productos = $productos->getTodos();
}
$vlista->render();
