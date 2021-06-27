<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedido #<?=$this->pedido['id']?></title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="../static/css/detallepedido.css">	
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="../static/img/logomain.png" id="logo">				
					<h1>FunkyTown</h1>
				</div>
				<a href="../admin" class="boton">Panel Admin</a>		
		</div>
	</div>
	<div class="contenido">
		<h2>Pedido #<?=$this->pedido['id']?> - <?=$this->pedido['estado']?></h2>
		<p><?=$this->pedido['nombre']?> [ID: <?=$this->pedido['id_usuario']?>]</p>
		<p>Email: <?=$this->pedido['email']?> DNI: <?=$this->pedido['dni']?></p>
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
			<input type="submit" name="cancelar" value="Marcar como cancelado" id="cancelar">
			<input type="submit" name="despachar" value="Marcar como despachado" id="despachar">
		</form>
		<?php } else { ?>
			<p><?=$this->pedido['resultado']?> - <?=$this->pedido['fecha_reg']?></p>
		<?php } ?>
	</div>
</body>
<script src="../static/js/detallepedidoadm.js"></script>
</html>