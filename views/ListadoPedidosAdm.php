<?php

class ListadoPedidosAdm extends View{

	public $pedidos;

	public function __construct(){
		$this->pedidos = new Pedido();
		$this->pedidos = $this->pedidos->getTodosAdm();
	}



}