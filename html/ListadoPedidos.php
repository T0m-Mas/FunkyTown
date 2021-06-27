<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedidos de <?=$_SESSION['USER']['nombre']?></title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="static/css/pedidos.css">
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
		<h2>Tus Pedidos</h2>
		<table>
			<tr>
				<th>ID</th>
				<th>Productos</th>
				<th>Fecha</th>
				<th>Estado</th>
			</tr>
			<?php foreach($this->pedidos as $p) { ?>
				<tr id="<?=$p['id']?>" class="pedido"> 				
					<td><?=$p['id']?></td>
					<td><?=$p['descripcion']?></td>
					<td><?=$p['fecha']?></td>
					<td><?=$p['estado']?></td>					
				</tr>
			<?php } ?>
		</table>
		<a href="user?id=<?=$_SESSION['USER']['id']?>">Volver</a>
	</div>
</body>
</html>