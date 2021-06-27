<?php
//models/Categorias.php

class Categoria extends Model{

	public function getTodos(){

		$this->db->query("SELECT * FROM categoria");
		return $this->db->fetchAll();

	}

	public function getNom($id){
		if(!ctype_digit($id)) throw new ValidacionException('errgetNom1');
		if($id<=0) throw new ValidacionException('errgetNom2');

		$this->db->query("SELECT descripcion FROM categoria WHERE id=$id");
		$data = $this->db->fetch();

		return $data['descripcion'];
	}

	public function existe($id){

		if(!ctype_digit($id)) throw new ValidacionException('errexiste1');
		if($id<=0) throw new ValidacionException('errexiste2');

		$this->db->query("SELECT id FROM categoria WHERE id = $id");
		if($this->db->numRows()==1){
			return true;
		}else{
			return false;
		}


	}

}
