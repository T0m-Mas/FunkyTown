<?php

class UserPanel extends view{

	public $detalles;

	public function __construct(){
		$this->detalles = new Usuario();
		$this->detalles = $this->detalles->getDetalles($_SESSION['USER']['id']);
	}
	
}