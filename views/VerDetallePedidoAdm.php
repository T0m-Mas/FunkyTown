<?php
class VerDetallePedidoAdm extends View{

	public $pedido;
	
	public function __construct($id){
		$this->pedido = new Pedido();
		$this->pedido = $this->pedido->getDetalle($id);
	}


}