<?php

class Database{
	//encapsular todo lo que tiene que ver con mysql
	private $cn = false;
	private $res;
	private static $instance = false;
	private $dir,$user,$pass,$base;

	private function __construct(){

	}

	public static function getInstance(){ //metodo estatico para prevenir que haya mas de una instancia (Singleton) la clase debe poseer constructor privado.
		if(!self::$instance) { // self se usa cuando se refiere a un miembro estatico de la clase (this es para miembros de la instancia de la clase)
			self::$instance = new Database();
		}
			return self::$instance;// se devuelve siempre la misma instancia en memoria

	}

	private function connect(){
		$this->cn = mysqli_connect("localhost","root","","base_ropa");
	}

	public function query($q){
		if(!$this->cn) $this->connect(); //si hay 
		$this->res = mysqli_query($this->cn,$q);
		if(!$this->res) die(mysqli_error($this->cn)." -- Consulta: ".$q);
	}

	public function numRows(){
		return mysqli_num_rows($this->res);
	}

	public function fetch(){
		return mysqli_fetch_assoc($this->res);
	}

	public function fetchAll(){
		$aux = array();
		while($fila=$this->fetch()) $aux[]=$fila;
		return $aux;
	}

	public function escape($str){
		if(!$this->cn) $this->connect();
		return mysqli_escape_string($this->cn,$str);
	}

	public function escapeWildcapds($str){
		$str = str_replace('%','\%',$str);
		$str = str_replace('_','\_',$str);
		return $str;
	}

}

//$db = Database::getInstance(); // las llamadas a metodos estaticos se hacen con ::

/* NO QUIERO QUE
$db = new Database();   LAS CONECCIONES NO SON GRATIS!!!
$db2 = new Database();
$db3 = new Database();  PATRON SINGLETON
$db4 = new Database();
*/



?>