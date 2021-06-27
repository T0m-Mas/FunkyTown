<?php

class ListadoPedidos extends View{

	protected $pedidos;

	public function __construct($id){
		$this->pedidos = new Pedido();
		$this->pedidos = $this->pedidos->getTodosUser($id);
	}
}