<?php

class Modificacion extends View{

	protected $producto;
	public $categorias;
	public $alert = false;

	public function __construct($p){
		$this->producto = array();
		$this->producto = $p;

		$c = new Categoria();
		$this->categorias = $c->getTodos();

		$this->producto['categoria_nom'] = $c->getNom($p['id_categoria']);
	}


}