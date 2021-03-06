<!DOCTYPE html>
<html>
<head>
	<title>FunkyTown Indumentaria</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/home.css">
	<link rel="icon" href="static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo" alt="none">				
					<h1>FunkyTown</h1>
				</div>
				<?php if($_SESSION['logeado']){ ?>
					<div class="go_chango">
						<a href="carrito">
							<?php if(isset($_SESSION['carrito'])){ ?>
								<img src="static/img/chango_on.png" alt="none">
							<?php }else{ ?>
								<img src="static/img/chango_off.png" alt="none">
							<?php } ?>
						</a>
					</div>
				<?php } ?>
			<div class="menu">
				<div class="menu_contenido">
					<a href="catalogo" class="boton">Productos</a>
					<span class="boton" id="bnosotros">Nosotros</span>
					<span class="boton" id="bcontacto">Contacto</span>
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
		<div id="nosotros">	
		<h2>¿Quienes somos?</h2>
		<p>Somos un emprendimiento indie que se formo al mediados del 2017 nos dedicamos a la venta de ropa alternativa</p>
		<p>Contamos con diseños propios asi como diseños para el publico general, Siempre buscamos inovar y renovar nuestro catalogo.</p>
		<p>Te invitamos a que veas nuestros productos</p>
		<img src="static/img/logomain.png" id="img_contenido" alt="none">
		</div>

		<div id="contacto">	
		<h2>Contactanos</h2>
		<p>Telefono: 1234-1234 / 3412-3412</p>
		<p>WhatsApp: 11-2233-4455</p>
		<p>Email: funkytown@info.com.ar</p>
		<p>Av Rivadavia 2235 - Moron</p>


		<h2>Encontranos en:</h2>
		<table>
			<tr><td><a href="https://www.instagram.com"><img src="static/img/logoinsta.png" alt="none"></a></td>
			<td><a href="https://www.facebook.com"><img src="static/img/logofb.png" alt="none"></a></td>
			<td><a href="https://www.mercadolibre.com"><img src="static/img/logoml.png" alt="none"></a></td></tr>
		</table>

		</div>


	</div>
	<script src="static/js/home.js"></script>
</body>
</html>