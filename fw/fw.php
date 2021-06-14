<?php
	//fw/fw.php

	session_start();
	if(!isset($_SESSION["logeado"])){	
		$_SESSION["logeado"] = false;
		$_SESSION["privilegios"] = false;
	}
	require '../fw/Database.php';	
	require '../fw/Model.php';
	require '../fw/View.php';