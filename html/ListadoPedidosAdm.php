<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de Pedidos</title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="../static/css/pedidos.css">
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
		<table>
			<tr>
				<th>ID</th>
				<th>Usuario</th>
				<th>Productos</th>
				<th>Fecha</th>
				<th>Estado</th>
			</tr>
			<?php foreach($this->pedidos as $p) { ?>
				<tr id="<?=$p['id']?>" class="pedido"> 				
					<td><?=$p['id']?></td>
					<td><?=$p['nombre']?></td>
					<td><?=$p['descripcion']?></td>
					<td><?=$p['fecha']?></td>
					<td><?=$p['estado']?></td>					
				</tr>
			<?php } ?>
		</table>
	</div>
</body>
<script type="text/javascript">
	"use strict";

	<?php foreach ($this->pedidos as $p) { ?>
		document.getElementById(<?=$p['id']?>).onclick = function(){
			window.location.href = "verpedido?id=<?=$p['id']?>";
		}
	<?php } ?>

</script>
</html>