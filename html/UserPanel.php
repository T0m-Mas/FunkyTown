<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Panel de usuario</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/userpanel.css">
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
		<h2>Panel De Usuario</h2>
		<div id="stats">
			<h2>Tus Datos:</h2>
			<div class="colizq">
				<p>Nombre: <?=$_SESSION['USER']['nombre']?> <?=$_SESSION['USER']['apellido']?></p>
				<p>DNI: <?=$_SESSION['USER']['dni']?></p>
				<p>Email: <?=$_SESSION['USER']['user']?></p>
				<p>Fecha de Registro: <?=$this->detalles['fecha_registro']?></p>
			</div>
			<div class="colder">
				<p><?=$this->detalles['num_pedidos']?> Pedidos Totales</p>
				<p><?=$this->detalles['pedidos_pendientes']?> Pedidos Por Despachar</p>
				<p><?=$this->detalles['productos_pedidos']?> Productos Pedidos</p>
				<p><?=$this->detalles['ultimo_pedido']?> Ultimo Pedido</p>
			</div>
		</div>
		<span id="show">Mostrar Estadisticas</span>
		<a href="listadopedidos?id=<?=$_SESSION['USER']['id']?>">Ver Mis Pedidos</a>
		<a href="carrito">Carrito</a>
		<a href="logout">Cerrar la sesion</a>
		<a href="home">Volver</a>
		<p class="letrachica">Si quieres Solicitar la Baja o Modificacion de tus datos escribenos a support@funkytown.com </p>
	</div>
</body>
<script src="static/js/userpanel.js"></script>
</html>