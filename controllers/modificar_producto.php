<?php

// controllers/modificar_producto.php

require '../fw/fw.php';
require '../models/Producto.php';
require '../models/Categoria.php';
require '../views/Modificacion.php';

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

if(isset($_POST['guardar'])){ //guardo
	$pr = $p->getID($_GET['id']);

	if($pr['titulo']!=$_POST['nuevotitulo'])
		$p->setTitulo($_GET['id'],$_POST['nuevotitulo']);

	if($pr['descripcion']!=$_POST['nuevadescripcion'])
		$p->setDescripcion($_GET['id'],$_POST['nuevadescripcion']);

	if($pr['id_categoria']!=$_POST['nuevacategoria'])
		$p->setCategoria($_GET['id'],$_POST['nuevacategoria']);

	if($pr['precio_venta']!=$_POST['nuevoprecio'])
		$p->setPrecio($_GET['id'],$_POST['nuevoprecio']);

	if($_FILES['nuevafoto']['tmp_name']!=""){ //cambio imagen
		if($_FILES['nuevafoto']['size']>2097152) die("tamaño maximo de imagen: 2Mbs");
		$img = addslashes(file_get_contents($_FILES['nuevafoto']['tmp_name']));	
		$p->setImagen($_GET['id'],$img);
	}
}

if(isset($_POST['eliminar'])){
	$p->eliminar($_GET['id']);
	header("location: inventario");
}
$view = new Modificacion($p->getID($_GET['id']));
$view->render();


