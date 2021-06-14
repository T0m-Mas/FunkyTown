<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Carrito</title>
</head>
<body>
	<?php if($this->carrito==false){ ?>
		<p>Tu carrito esta vacio</p>
	<?php }else{ ?>
		<table>
			<tr><th>Producto</th><th>Talle</th><th>Cantidad</th><th>Precio</th></tr>
		<?php foreach($this->carrito->productos as $p) { ?>
			<tr>
				<td><?=$p['titulo']?></td>
				<td><?=$p['talle']?></td>
				<td><?=$p['cantidad']?></td>
				<td><?=$p['precio_venta']?></td>
			</tr>
		<?php } ?>
			<tr><td colspan="3">Total:</td><td><?=$this->carrito->total?></td></tr>
		</table>
	<?php } ?>

</body>
</html>