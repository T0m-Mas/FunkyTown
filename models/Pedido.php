<?php

class Pedido extends Model{

	public $productos;
	public $total;

	public function __construct(){
		$this->productos = array();
		$this->total = 0.0;
		$this->wakeup();
	}

	public function wakeup(){ /*Funcion para llamar a la instancia, no la hago en el constructor ya que la instancia se 														pierde al serializar/deserializar*/
		$this->db = Database::getInstance();
	}

	public function agregar($id,$talle,$cantidad){
		$p = new Producto();
		$producto = $p->getIDParaPedido($id);

		$this->db = Database::getInstance(); //La instancia se pierde al deserializar 

		if(strlen($talle)>5||strlen($talle)==0) throw new ValidacionException('erragregar 1');
		$talle = $this->db->escape($talle);
		$this->db->query("SELECT talle FROM stock WHERE id_producto =$id and talle = '$talle'");
		if($this->db->numRows()!=1) throw new ValidacionException('erragregar 2');
		$producto['talle'] = $talle;
		$this->db->fetchAll();

		if(!ctype_digit($cantidad)) throw new ValidacionException('erragregar 3');
		if($cantidad <= 0) throw new ValidacionException('erragregar 4');		
		$producto['cantidad'] = $cantidad;

		$producto['subtotal'] = $producto['precio_venta'] * $producto['cantidad'];

		/*VALIDO SI DE VERDAD HAY DISPONIBLES*/
		$tallesdisp = $p->getTalles($id);
		if($tallesdisp==false) throw new ValidacionException('erragregar 6');



		if(count($tallesdisp)==2){ /*2 = 1 talle (talle,cantidad)*/
			if($tallesdisp['talle']==$talle && $tallesdisp['cantidad']>=$cantidad){
				$flag = 'ok';
				$producto['disponibles'] = $tallesdisp['cantidad']; //guardo la cantidad para validar desp
			}
		}else{
			foreach ($tallesdisp as $t) {
				if($t['talle']==$talle && $t['cantidad']>=$cantidad){
					$flag = 'ok';
					$producto['disponibles'] = $t['cantidad'];
				}
			}
		}
		if(!isset($flag)) die('erragregar 7');


		foreach($this->productos as $key => $prs){ //si el producto ya esta en el carrito...
			if($prs['id'] == $producto['id'] && $prs["talle"] == $producto['talle'] ){
				$existente = true;
				if($this->productos[$key]['disponibles']<$this->productos[$key]['cantidad'] + $producto['cantidad']){
					return 1;
				}
				$this->productos[$key]['cantidad'] += $producto['cantidad'];
				$this->productos[$key]['subtotal'] += $producto['subtotal'];
			}
		}

		if(!isset($existente)){
			$this->productos[] = $producto;
		}
		$this->total = $this->total + $producto['subtotal'];	
	}

	public function quitar($key){
		if(array_key_exists($key, $this->productos)){
			$this->total -= $this->productos[$key]['subtotal'];
			unset($this->productos[$key]);
		}
		if(count($this->productos) == 0)
			return true;
	}

	public function enviar($id){
		$this->wakeup();
		if(!ctype_digit($id)) throw new ValidacionException("errenvio 1");
		if($id<0) throw new ValidacionException("errenvio 2");
		$this->db->query("SELECT id FROM usuario where id=$id");
		if(!$this->db->numRows()==1) throw new ValidacionException("errenvio 3");

		$this->db->query(
			"INSERT INTO pedido (id_usuario,monto_total) VALUES ($id,$this->total)"
		);

		$this->db->query(
			"SELECT id FROM pedido where id_usuario = $id AND estado = 0"
		);

		$idp = $this->db->fetch();
		$idp = $idp['id'];

		foreach($this->productos as $p){
			$this->db->query(
				"INSERT INTO pedido_producto (id_pedido,id_producto,talle,cantidad)
				 VALUES ($idp,".$p['id'].",'".$p['talle']."',".$p['cantidad'].")"
			);
		}

		$this->db->query("UPDATE pedido SET estado = 1 WHERE id = $idp");

	}

	public function getTodosUser($id){

		if(!ctype_digit($id)) throw new ValidacionException("errgetTodosUser1");
		if($id<0) throw new ValidacionException("errgetTodosUser2");
		$this->db->query("SELECT id FROM usuario WHERE id=$id");
		if($this->db->numRows()!=1) throw new ValidacionException("errgetTodosUser3");

		$this->db->query(
			"SELECT p.id,
			 p.fecha,
			 e.descripcion as 'estado',
			 p.monto_total 
			 from pedido p
			 left join estado e on e.id = p.estado
			 WHERE p.id_usuario = $id
			 order by fecha"
		);

		$ret = $this->db->fetchAll();

		foreach($ret as $key => $p){
			$pid = $p['id'];
			$this->db->query(
				"SELECT titulo FROM producto
				 left join pedido_producto pp on pp.id_producto = producto.id
				 where pp.id_pedido = $pid"
			);

			$productos = $this->db->fetchAll();

			$str = "";

			foreach($productos as $pr ){
				$str = $str . $pr['titulo'] . " - ";
			}
			$str = substr($str,0,strlen($str)-3);

			$ret[$key]['descripcion'] = $str;

		}

		return $ret;
	}

	public function getTodosAdm(){

		$this->db->query(
			"SELECT p.id,
			 p.id_usuario,
			 CONCAT(u.nombre,' ',u.apellido) as 'nombre',
			 u.dni,
			 p.fecha,
			 e.descripcion as 'estado',
			 p.monto_total 
			 from pedido p
			 left join usuario u on u.id = p.id_usuario
			 left join estado e on e.id = p.estado
			 order by fecha"
		);

		$ret = $this->db->fetchAll();

		foreach($ret as $key => $p){
			$pid = $p['id'];
			$this->db->query(
				"SELECT titulo FROM producto
				 left join pedido_producto pp on pp.id_producto = producto.id
				 where pp.id_pedido = $pid"
			);

			$productos = $this->db->fetchAll();

			$str = "";

			foreach($productos as $pr ){
				$str = $str . $pr['titulo'] . " - ";
			}
			$str = substr($str,0,strlen($str)-3);

			$ret[$key]['descripcion'] = $str;

		}

		return $ret;
	}

	public function getDetalle($id){
		/*VALIDAR*/

		if(!ctype_digit($id)) throw new ValidacionException("errgetDetalle1");
		if($id<0) throw new ValidacionException("errgetDetalle2");
		$this->db->query("SELECT id FROM pedido where id=$id");
		if(!$this->db->numRows()==1) throw new ValidacionException("errgetDetalle3");

		$this->db->query(
			"SELECT p.id,
			 p.id_usuario,
			 CONCAT(u.nombre,' ',u.apellido) as 'nombre',
			 u.email,
			 u.dni,
			 p.fecha,
			 p.estado as 'estado_id',
			 e.descripcion as 'estado',
			 ap.resultado as 'resultado',
			 ap.fecha as 'fecha_reg',
			 p.monto_total 
			 from pedido p
			 left join usuario u on u.id = p.id_usuario
			 left join estado e on e.id = p.estado
			 left join auditoria_pedidos ap on p.id = ap.id_pedido
			 WHERE p.id = $id"
		);

		$ret = $this->db->fetch();

		$id = $ret['id'];
		$this->db->query(
			"SELECT id_producto,talle,cantidad,p.titulo,p.precio_venta * cantidad as 'precio' 
			 from pedido_producto
			 left join producto p on p.id = id_producto
			 WHERE id_pedido = $id"
		);

		$ret['productos'] = $this->db->fetchAll();

		return $ret;

	}

	public function cancelaradm($id){
		if(!ctype_digit($id)) throw new ValidacionException("errcancelar1");
		if($id<0) throw new ValidacionException("errcancelar2");
		$this->db->query("SELECT id FROM pedido where id=$id");
		if(!$this->db->numRows()==1) throw new ValidacionException("errcancelar3");

		$this->db->query(
			"UPDATE pedido SET estado = -2 WHERE id= $id"
		);
	}

	public function cancelar($id){
		if(!ctype_digit($id)) throw new ValidacionException("errcancelar1");
		if($id<0) throw new ValidacionException("errcancelar2");
		$this->db->query("SELECT id FROM pedido where id=$id");
		if(!$this->db->numRows()==1) throw new ValidacionException("errcancelar3");

		$this->db->query(
			"UPDATE pedido SET estado = -1 WHERE id= $id"
		);
	}

	public function despachar($id){
		if(!ctype_digit($id)) throw new ValidacionException("errcancelar1");
		if($id<0) throw new ValidacionException("errcancelar2");
		$this->db->query("SELECT id FROM pedido where id=$id");
		if(!$this->db->numRows()==1) throw new ValidacionException("errcancelar3");

		$this->db->query(
			"UPDATE pedido SET estado = 2 WHERE id= $id"
		);
	}

	

}
