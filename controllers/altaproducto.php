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
$c = new Categoria();
$view->categorias = $c->getTodos();

if(isset($_POST['guardar'])){//Registro producto nuevo

	$p = new Producto();

	if($_FILES['imagen']['tmp_name']!=''){
		if($_FILES['imagen']['size']>100000){ //100kb
			$view->alert = "La imagen no puede superar los 100Kbs de tamaño";
			$view->render();
			exit();
		}else{
			$img = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));		
		}
	}else{
		$img = null;
	}

	$res = $p->AgregarNuevo($_POST['titulo'],
							$_POST['descripcion'],
							$_POST['categoria'],
							$_POST['precio'],
							$img);
			
	header("location: altaok");
	exit();		

}
$view->render();