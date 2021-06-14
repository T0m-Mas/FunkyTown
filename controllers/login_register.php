<?php 

	require '../fw/fw.php';
	require '../models/Usuario.php';
	require '../views/Login.php';
	require '../views/Register.php';
	
	$vlogin = new Login();
	$vregister = new Register();

	if(isset($_POST["registrar"])){
		$user = new Usuario();
		$res = $user->RegistrarNuevo($_POST["user"],$_POST["pass"],$_POST["nom"],$_POST["ape"],$_POST["dni"]);

		if($res == 0){ //registro correcto
			$_SESSION["logeado"] = true;
			$_SESSION["USER"] = $user->toArray();
			$_SESSION["privilegios"] = false;
			header("location: home");
			exit;
		}elseif($res == 1){ //ya existe mail
			$vregister->error = "Ya existe un usuario registrado con este correo";
		}elseif($res == 2){ //ya existe dni
			$vregister->error = "Ya existe un usuario registrado con este DNI";
		}

	}
	if(isset($_POST["logear"])){
		$user = new Usuario();
		$res = $user->Login($_POST["user"],$_POST["pass"]);
		if(!$res){
			$vlogin->error = "Error de correo o contraseña";
		}else{
			$_SESSION["logeado"] = true;
			$_SESSION["USER"] = $user->toArray();
			if($user->getPrivilegio()==1){
				$_SESSION["privilegios"] = true;
			}else{
				$_SESSION["privilegios"] = false;
			}
			header("location: home");
			exit;
		}
	}

	if(!isset($_GET["registrarse"])){
		$vlogin->render();
	}
	else{
		$vregister->render();
	}


?>