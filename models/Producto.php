<?php
//models/Producto.php

class Producto extends Model{

	public function getTodos(){
		$this->db->query(
			"SELECT p.*,SUM(s.cantidad-s.reserva) as stock FROM producto p
			 LEFT JOIN stock s on s.id_producto = p.id
			 GROUP BY p.id
			 ORDER BY stock desc"
		);
		
		if($this->db->numRows()==0){
			return false;
		}

		return $this->db->fetchAll();
	}

	public function getTodosOrdenadosNombre(){
		$this->db->query(
			"SELECT p.*,SUM(s.cantidad-s.reserva) as stock FROM producto p
			 LEFT JOIN stock s on s.id_producto = p.id
			 GROUP BY p.id
			 ORDER BY p.titulo"
		);
		
		if($this->db->numRows()==0){
			return false;
		}

		return $this->db->fetchAll();
	}

	public function getTitulo($s){

		if(strlen($s)==0) throw new ValidacionException("errgetTitulo1");
		if(strlen($s)>40) throw new ValidacionException("errgetTitulo2");
		$s = $this->db->escape($s);
		$s = str_replace("%","\%",$s);
		$s = htmlentities($s);


		$this->db->query(
			"SELECT p.*,SUM(s.cantidad-s.reserva) as stock FROM producto p
			 LEFT JOIN stock s on s.id_producto = p.id
			 WHERE p.titulo like '%$s%'
			 GROUP BY p.id
			 ORDER BY stock desc,p.id_categoria"
		);

		if($this->db->numRows()==0){
			return false;
		}

		return $this->db->fetchAll();

	}

	public function getCategoria($c){
		if(!ctype_digit($c)) throw new ValidacionException("errGetcat 1");
		if($c<0) throw new ValidacionException("errGetcat 2");
		if($c==0) return $this->getTodos(); //si categoria = 0 devuelvo todo
		$this->db->query("SELECT id FROM categoria WHERE id = $c");
		if($this->db->numRows()==0) throw new ValidacionException("errGetcat 3");


		$this->db->query(
			"SELECT p.*,SUM(s.cantidad-s.reserva) as stock FROM producto p
			 LEFT JOIN stock s on s.id_producto = p.id
			 WHERE p.id_categoria = $c
			 GROUP BY p.id
			 ORDER BY stock desc"
		);
		return $this->db->fetchAll();
	}

	public function getID($id){		
		if(!ctype_digit($id)) throw new ValidacionException("errGetid 1");
		if($id<=0) throw new ValidacionException("errGetid 2");
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) throw new ValidacionException("errGetid 3");

		$this->db->query("SELECT * FROM producto WHERE id = $id");
		return $this->db->fetch();

	}
	public function getIDParaPedido($id){		
		if(!ctype_digit($id)) throw new ValidacionException("errGetid 1");
		if($id<=0) throw new ValidacionException("errGetid 2");
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) throw new ValidacionException("errGetid 3");

		$this->db->query("SELECT id,titulo,descripcion,id_categoria,precio_venta FROM producto WHERE id = $id");
		return $this->db->fetch();

	}

	public function AgregarNuevo($titulo,$descripcion,$categoria,$precio,$img){
		/*Validar*/
		if(strlen($titulo)==0) throw new ValidacionException("errAlta1");
		if(strlen($titulo)>40) throw new ValidacionException("errAlta2");
		$titulo = $this->db->escape($titulo);
		$titulo = htmlentities($titulo);

		if(strlen($descripcion)==0) throw new ValidacionException("errAlta3");
		if(strlen($descripcion)>256) throw new ValidacionException("errAlta4");
		$descripcion = $this->db->escape($descripcion);
		$descripcion = htmlentities($descripcion);

		if(!ctype_digit($categoria)) throw new ValidacionException("errAlta5");
		if($categoria<=0) throw new ValidacionException("errAlta6");

		$precio = str_replace(',','.',$precio);
		if(!is_numeric($precio)) throw new ValidacionException("errAlta7");
		if($precio<0) throw new ValidacionException("errAlta8");

		$this->db->query(  "INSERT INTO producto (titulo,descripcion,id_categoria,precio_venta,img) 
							VALUES ('$titulo','$descripcion', $categoria,'$precio','$img')");


	}

	public function setTitulo($id,$titulo){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		if(strlen($titulo)==0) return;
		if(strlen($titulo)>40) return;
		$titulo = $this->db->escape($titulo);
		$titulo = htmlentities($titulo);


		$this->db->query("UPDATE producto SET titulo = '$titulo' WHERE id = $id");


	}

	public function setDescripcion($id,$descripcion){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		if(strlen($descripcion)==0) return;
		if(strlen($descripcion)>256) return;
		$descripcion = $this->db->escape($descripcion);
		$descripcion = htmlentities($descripcion);

		$this->db->query("UPDATE producto SET descripcion = '$descripcion' WHERE id = $id");

	}

	public function setCategoria($id,$categoria){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		if(!ctype_digit($categoria)) return;
		if($categoria<=0) return;
		$c = new Categoria();
		if(!$c->existe($categoria)) return;

		$this->db->query("UPDATE producto SET id_categoria = $categoria WHERE id = $id");

	}

	public function setPrecio($id,$precio){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		$precio = str_replace(',','.',$precio);
		if(!is_numeric($precio)) return;
		if($precio<0) return;

		$this->db->query("UPDATE producto SET precio_venta = '$precio' WHERE id = $id");

	}

	public function setImagen($id,$img){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		$this->db->query("UPDATE producto SET img = '$img' WHERE id = $id");

	}

	public function eliminar($id){
		if(!ctype_digit($id)) return;
		if($id<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) return;

		$this->db->query("DELETE FROM producto WHERE id = $id");
	}

	public function getTalles($id){
		if(!ctype_digit($id)) throw new ValidacionException("errGetid 1");
		if($id<=0) throw new ValidacionException("errGetid 2");
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) throw new ValidacionException("errGetid 3");

		$this->db->query("SELECT talle,cantidad-reserva as 'cantidad' FROM stock WHERE id_producto=$id AND cantidad-reserva<>0");
		if($this->db->numRows()>0)			
			return $this->db->fetchAll();
		else
			return false;
	}

	
}
