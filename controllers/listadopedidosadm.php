<?php

require '../fw/fw.php';
require '../views/ListadoPedidosAdm.php';
require '../models/Pedido.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!$_SESSION['USER']['privilegio']==1){
	header("location: home");
	exit;
}

$v = new ListadoPedidosAdm();
$v->render();

