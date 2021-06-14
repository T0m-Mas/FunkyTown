<?php

// controllers/paneladmin.php

require '../fw/fw.php';
require '../views/PanelAdmin.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}
if(!$_SESSION['USER']['privilegio']==1){
	header("location: home");
	exit;
}

$view = new PanelAdmin();
$view->render();

