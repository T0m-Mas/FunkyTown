<?php

class Pedido extends Model{

	public $productos;
	public $total;

	public function __construct(){
		$this->productos = array();
		$this->total = 0.0;
		$this->db = Database::getInstance();
	}

	public function agregar($id,$talle,$cantidad){
		$p = new Producto();
		$producto = $p->getIDParaPedido($id);
		
		/*VALIDARR!!*/

		if(strlen($talle)>5||strlen($talle)==0) die('erragregar 1');
		$talle = $this->db->escape($talle);
		$this->db->query("SELECT talle FROM stock WHERE id_producto =$id and talle = '$talle'");
		if($this->db->numRows()!=1) die('erragregar 2');
		$producto['talle'] = $talle;

		if(!ctype_digit($cantidad)) die('erragregar 3');
		if($cantidad <= 0) die('erragregar 4');
		$s = new Stock();
		$s = $s->getID($id);
		if($s['cantidad'] < $cantidad ) die('erragregar 5');
		$producto['cantidad'] = $cantidad;
		//var_dump($producto);

		$this->productos[count($this->productos)] = $producto;
		//var_dump($this->productos);
		$this->total = $this->total + $producto['precio_venta'];
	}


}