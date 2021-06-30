<?php

// controllers/userpanel.php

require '../fw/fw.php';
require '../models/Usuario.php';
require '../views/UserPanel.php';

if(!isset($_SESSION['USER'])){
	header("location: home");
	exit;
}


$view = new UserPanel();
$view->render();



