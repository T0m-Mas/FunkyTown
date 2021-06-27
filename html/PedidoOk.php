<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedido Exitoso</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/pedidoOK.css">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo">				
					<h1>FunkyTown</h1>
				</div>
				<?php if($_SESSION['logeado']){ ?>
					<div class="go_chango">
						<a href="carrito">
							<?php if(isset($_SESSION['carrito'])){ ?>
								<img src="static/img/chango_on.png">
							<?php }else{ ?>
								<img src="static/img/chango_off.png">
							<?php } ?>
						</a>
					</div>
				<?php } ?>
			<div class="menu">
				<div class="menu_contenido">
					<a href="catalogo" class="boton">Volver al Catalogo</a>
				</div>
				<div class="menu_usuario">
					<?php if(!$_SESSION['logeado']){ ?>
						<a href="login" id="blogin" class="boton">Iniciar Sesion/Registrarse</a>
					<?php }else{ ?> 
						<?php if($_SESSION['privilegios']){ ?>
							<a href="admin" class="boton">Panel Admin</a>
						<?php }else {?>
							<a href="user?id=<?=$_SESSION['USER']['id']?>" class="boton" id="user">Hola <?=$_SESSION['USER']['nombre']?>!</a>
						<?php } ?>
						<a href="logout" id="blogout" class="boton">Cerrar Sesion</a>
					<?php } ?>			
				</div>
			</div>
		</div>
	</div>
	<div class="contenido">
		<h2>Tu Pedido fue Procesado con Exito</h2>
		<p>Nuestro Staff se contactara para coordinar pago y envio</p>
		<p>¡Gracias por Elegirnos!</p>
	</div>

</body>
</html>