<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesion</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/login_register.css">
	<link rel="icon" href="static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo" alt="none">				
					<h1>FunkyTown</h1>
				</div>			
		</div>
	</div>
	<div class="contenido">
	<h2>Iniciar Sesion</h2>
	<div class="formlogin">
		<form method="POST">
			<span class="campo">
				<label for="user">Email:</label>
				<input type="text" name="user" id="user">
			</span>
			<span class="campo">
				<label for="user">Contraseña:</label>
				<input type="password" name="pass" id="pass">
			</span>
			<input type="submit" class="btn" name="logear" id="btn_login" value="Iniciar Sesion">
			<p class="error" id="error"><?=$this->error?></p>
		</form>
	</div>
	<span class="registro">¿No tienes cuenta? <a href="login?registrarse=true">¡Registrate Aqui!</a></span>
	</div>
	<script src="static/js/login.js"></script>
</body>
</html>