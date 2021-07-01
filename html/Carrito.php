<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Carrito</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/chango.css">
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
					<a href="catalogo" class="boton">Volver al Catalogo</a>
				</div>
				<div class="menu_usuario">
					<?php if(!$_SESSION['logeado']){ ?>
						<a href="login" id="blogin" class="boton">Iniciar Sesion/Registrarse</a>
					<?php }else{ ?> 
						<?php if($_SESSION['privilegios']){ ?>
							<a href="admin" class="boton">Panel Admin</a>
						<?php }else {?>
							<a href="user?id=<?=$_SESSION['USER']['id']?>" class="boton">Hola <?=$_SESSION['USER']['nombre']?>!</a>
						<?php } ?>
						<a href="logout" id="blogout" class="boton">Cerrar Sesion</a>
					<?php } ?>			
				</div>
			</div>
		</div>
	</div>
	<div class="contenido">
		<?php if($this->carrito==false){ ?>
			<p>Tu carrito esta vacio</p>
		<?php }else{ ?>
			<h2>Mi Carrito</h2>
			<table>
				<tr><th>Producto</th><th>Talle</th><th>Cantidad</th><th>Precio</th></tr>
			<?php foreach($this->carrito->productos as $k => $p) { ?>
				<tr>
					<td><?=$p['titulo']?></td>
					<td><?=$p['talle']?></td>
					<td><?=$p['cantidad']?></td>
					<td>$<?=$p['subtotal']?></td>
					<td class="opc">
						<form method="POST">
							<input type="submit" name="quitar" value="X">
							<input type="hidden" name="key" value="<?=$k?>">
						</form>
					</td>
				</tr>
			<?php } ?>
				<tr><td colspan="3">Total:</td><td>$<?=$this->carrito->total?></td></tr>
			</table>
			<form method="POST">
				<input type="submit" class="btn_confirmar" name="confirmar" value="Confirmar Pedido">
			</form>

		<?php } ?>
	</div>
	<script src="static/js/carrito.js"></script>
</body>
</html>