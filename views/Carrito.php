<?php

class Carrito extends View{

	public $carrito;

	function __construct(){
		if(isset($_SESSION['carrito'])){
			$p = unserialize($_SESSION['carrito']);
			var_dump($p);
			$this->carrito = $p;
		}
		else{
			$this->carrito = false;
		}
		//var_dump($this->carrito);
	}

}