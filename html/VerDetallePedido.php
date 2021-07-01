<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedido #<?=$this->pedido['id']?></title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="static/css/detallepedido.css">	
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
		<h2>Pedido #<?=$this->pedido['id']?> - <?=$this->pedido['estado']?></h2>
		<p><?=$this->pedido['nombre']?> [DNI: <?=$this->pedido['dni']?>]</p>
		<p><?=$this->pedido['email']?></p>
		<p><?=$this->pedido['fecha']?></p>

		<h2>Productos:</h2>

		<table>
				<tr><th>Producto</th><th>Talle</th><th>Cantidad</th><th>Precio</th></tr>
			<?php foreach($this->pedido['productos'] as $p) { ?>
				<tr>
					<td><?=$p['titulo']?></td>
					<td><?=$p['talle']?></td>
					<td><?=$p['cantidad']?></td>
					<td>$<?=$p['precio']?></td>
				</tr>
			<?php } ?>
				<tr><td colspan="3">Total:</td><td>$<?=$this->pedido['monto_total']?></td></tr>
		</table>
		<?php if($this->pedido['estado_id']==1){ ?>
		<form method="POST">
			<input type="submit" name="cancelar" value="Cancelar pedido" id="cancelar">
		</form>
		<?php } else { ?>
			<p><?=$this->pedido['resultado']?> - <?=$this->pedido['fecha_reg']?></p>
		<?php } ?>
		<a href="listadopedidos?id=<?=$_SESSION['USER']['id']?>">Volver</a>
	</div>
	<script src="static/js/detallepedido.js"></script>
</body>
</html>