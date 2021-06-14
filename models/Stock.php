<?php
class Stock extends Model{

	public function getID($id){
		if(!ctype_digit($id)) die("errGetid 1");
		if($id<=0) die("errGetid 2");
		$this->db->query("SELECT id FROM producto WHERE id = $id");
		if($this->db->numRows()==0) die("errGetid 3");

		$this->db->query("SELECT id_producto,talle,cantidad-reserva as cantidad,reserva FROM stock WHERE id_producto = $id");
		return $this->db->fetchall();
	}

	public function setStock($idp,$talle,$cantidad){
		if(!ctype_digit($idp)) return;
		if($idp<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $idp");
		if($this->db->numRows()==0) return;

		if(strlen($talle)>5 || strlen($talle) == 0) return;
		$talle = $this->db->escape($talle);

		if(!ctype_digit($cantidad)) return;
		if($cantidad<0) return;

		$this->db->query("UPDATE stock SET cantidad = $cantidad WHERE id_producto = $idp AND talle = '$talle'");

	}

	public function setStockSumar($idp,$talle,$cantidad){
		if(!ctype_digit($idp)) return;
		if($idp<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $idp");
		if($this->db->numRows()==0) return;

		if(strlen($talle)>5 || strlen($talle) == 0) return;
		$talle = $this->db->escape($talle);

		if(!ctype_digit($cantidad)) return;
		if($cantidad<0) return;

		$this->db->query("UPDATE stock SET cantidad = cantidad+$cantidad WHERE id_producto = $idp AND talle = '$talle'");

	}

	public function setStockRestar($idp,$talle,$cantidad){
		if(!ctype_digit($idp)) return;
		if($idp<=0) return;
		$this->db->query("SELECT id FROM producto WHERE id = $idp");
		if($this->db->numRows()==0) return;

		if(strlen($talle)>5 || strlen($talle) == 0) return;
		$talle = $this->db->escape($talle);

		if(!ctype_digit($cantidad)) return;
		if($cantidad<0) return;
		$this->db->query("SELECT cantidad FROM stock WHERE id_producto = $idp AND talle = '$talle'");
		$ca = $this->db->fetch();
		if(($ca['cantidad']-$cantidad) < 0){
			return 1;
		}		

		$this->db->query("UPDATE stock SET cantidad = cantidad-$cantidad WHERE id_producto = $idp AND talle = '$talle'");

	}

}