<?php
//models/Usuario.php
class Usuario extends Model{

	private $user; //mail
	private $privilegio;
	private $nombre;
	private $apellido;
	private $dni;
	private $id;	

	public function RegistrarNuevo($user,$pass,$nombre,$apellido,$dni){
		/*VALIDAR*/
		if(strlen($user)==0) throw new ValidacionException("errReg 1");
		if(strlen($user)>100) throw new ValidacionException("errReg 2");
		$user = $this->db->escape($user);
		$user = strtolower($user);
		$user = htmlentities($user);
		$this->user = $user;

		if(strlen($pass)==0) throw new ValidacionException("errReg 3");
		if(strlen($pass)>40) throw new ValidacionException("errReg 4");
		$pass = $this->db->escape($pass);
		$pass = sha1($pass);

		if(strlen($nombre)==0) throw new ValidacionException("errReg 5");
		if(strlen($nombre)>40) throw new ValidacionException("errReg 6");
		$nombre = $this->db->escape($nombre);
		$nombre = htmlentities($nombre);
		$this->nombre = $nombre;

		if(strlen($apellido)==0) throw new ValidacionException("errReg 7");
		if(strlen($apellido)>40) throw new ValidacionException("errReg 8");
		$apellido = $this->db->escape($apellido);
		$apellido = htmlentities($apellido);
		$this->apellido = $apellido;


		if(!ctype_digit($dni)) throw new ValidacionException("errReg 9");
		if($dni<0 || $dni>99999999) throw new ValidacionException("errReg 10");
		$this->dni = $dni;

		$this->privilegio = 0;

		/*VALIDO SI YA EXISTE*/
		$this->db->query("SELECT * FROM usuario WHERE email = '$user'"); //mail
		if($this->db->numRows()!=0) return 1; 

		$this->db->query("SELECT * FROM usuario WHERE dni = '$dni'"); //dni
		if($this->db->numRows()!=0) return 2;

		//var_dump($this->db);

		$this->db->query("INSERT INTO usuario (nombre,apellido,email,dni,password) VALUES ('$nombre','$apellido','$user',$dni,'$pass')");

		$this->db->query("SELECT id FROM usuario WHERE email = '$user' and password = '$pass'");
		$this->id = $this->db->fetch()["id"];

		return 0;
	}

	function Login($user,$pass){

		if(strlen($user)==0) throw new ValidacionException("errLog 1");
		if(strlen($user)>100) throw new ValidacionException("errLog 2");
		$user = strtolower($user);
		$user = $this->db->escape($user);

		if(strlen($pass)==0) throw new ValidacionException("errLog 3");
		if(strlen($pass)>40) throw new ValidacionException("errLog 4");
		$pass = $this->db->escape($pass);
		$pass = sha1($pass);

		$this->db->query("SELECT email,nombre,apellido,dni,privilegio,id FROM usuario WHERE email = '$user' and password = '$pass'");
		if($this->db->numRows()==1){
			$datos = $this->db->fetch();

			//var_dump($datos);

			$this->user = $datos['email'];
			$this->nombre = $datos['nombre'];
			$this->apellido = $datos['apellido'];
			$this->dni = $datos['dni'];
			$this->privilegio = $datos['privilegio'];
			$this->id = $datos['id'];

			return true;
		}
		return false;

	}
	function getPrivilegio(){
		return $this->privilegio;
	}
	function toArray(){
		$ret = array();
		$ret['id'] = $this->id;
		$ret['user'] = $this->user;
		$ret['nombre'] = $this->nombre;
		$ret['apellido'] = $this->apellido;
		$ret['dni'] = $this->dni;
		$ret['privilegio'] = $this->privilegio;
		return $ret;
	}

	function getDetalles($id){

		if(!ctype_digit($id)) throw new ValidacionException("errgetDetalles1");
		if($id<0) throw new ValidacionException("errgetDetalles2");
		$this->db->query("SELECT id FROM usuario WHERE id=$id");
		if($this->db->numRows()!=1) throw new ValidacionException("errgetDetalles3");

		$this->db->query(
			"SELECT fecha_registro,
			 COUNT(p.id) as 'num_pedidos',
			 (SELECT COUNT(p2.id) FROM pedido p2 WHERE p2.id_usuario = u.id AND p2.estado = 1) as 'pedidos_pendientes',
			 IFNULL((SELECT SUM(pp.cantidad) FROM pedido_producto pp 
			  LEFT JOIN pedido p on p.id = pp.id_pedido
			  WHERE p.id_usuario = u.id),0) as 'productos_pedidos',
			 IFNULL((SELECT MAX(p.fecha) from pedido p
			  WHERE p.id_usuario = u.id),'Nunca') as 'ultimo_pedido'
			 FROM usuario u
			 left join pedido p on p.id_usuario = u.id 
			 WHERE u.id=$id"
		);

		return $this->db->fetch();

	}


}
