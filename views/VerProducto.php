<?php

	class VerProducto extends View{

		protected $producto;
		protected $talles;
		protected $agotado = false;

		public function __construct($id){			
			$p = new Producto();
			$this->producto = $p->getID($id);
			$this->talles = $p->getTalles($id);
			if($this->talles == false){
				$this->agotado = true;
			}
		}


	}

