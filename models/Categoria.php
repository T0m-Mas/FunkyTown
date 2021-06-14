<?php
//models/Categorias.php

class Categoria extends Model{

	public function getTodos(){

		$this->db->query("SELECT * FROM categoria");
		return $this->db->fetchAll();

	}

	public function getNom($id){
		if(!ctype_digit($id)) return false;
		if($id<=0) return false;

		$this->db->query("SELECT descripcion FROM categoria WHERE id=$id");
		$data = $this->db->fetch();

		return $data['descripcion'];
	}

	public function existe($id){

		if(!ctype_digit($id)) return false;
		if($id<=0) return false;

		$this->db->query("SELECT id FROM categoria WHERE id = $id");
		if($this->db->numRows()==1){
			return true;
		}else{
			return false;
		}


	}

}