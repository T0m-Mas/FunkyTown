<?php 
// controllers/altaproducto.php

require '../fw/fw.php';
require '../views/Alta.php';
require '../models/Categoria.php';
require '../models/Producto.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!$_SESSION['USER']['privilegio']==1){
	header("location: home");
	exit;
}

$view = new Alta();

if(isset($_POST['guardar'])){//Registro producto nuevo

	$p = new Producto();

	$img = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
	//var_dump($img);
	//exit();
	
	$res = $p->AgregarNuevo( $_POST['titulo'],
							 $_POST['descripcion'],
							 $_POST['categoria'],
							 $_POST['precio'],
							 $img,
							);

	if($res==1){
		$view->error("La imagen no puede superar los 2Mbs de tamaño");
	}
	if($res==0){
		header("location: altaok");
		exit();
	}

}

$c = new Categoria();

$view->categorias = $c->getTodos();
$view->render();