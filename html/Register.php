<!DOCTYPE html>
<html>
<head>
	<title>Registrarse</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/login_register.css">
	<link rel="icon" href="static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo">				
					<h1>FunkyTown</h1>
				</div>			
		</div>
	</div>
	<div class="contenido">
	<h2>Registrarse</h2>
		<div class="formlogin">
			<form method="POST">
				<span class="campo2">
					<label for="nom">Nombre:</label>
					<input type="text" name="nom" id="nom" maxlength="40">
				</span>
				<span class="campo2">
					<label for="ape">Apellido:</label>
					<input type="text" name="ape" id="ape" maxlength="40">	
				</span>
				<span class="campo2">
					<label for="dni">DNI:</label>
					<input type="text" name="dni" id="dni"  maxlength="8">
				</span>
				<span class="campo2">
					<label for="user">Email:</label>
					<input type="text" name="user" id="user" maxlength="100">
				</span>
				<span class="campo2">	
					<label for="pass">Contraseña:</label>
					<input type="password" name="pass" id="pass"  maxlength="40">
				</span>
				<span class="campo2">
					<label for="pass2">Repita la Contraseña:</label>
					<input type="password" name="pass2" id="pass2">
				</span>
				<input type="submit" name="registrar" class="btn" id="btn_register" value="Registrarse">
				<p class="error" id="error"><?=$this->error?></p>
			</form>			
		</div>
		<span class="registro"><a href="login">Volver al login</a></span>
	</div>
</body>
<script src="static/js/register.js"></script>
</html>