<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedidos de <?=$_SESSION['USER']['nombre']?></title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="static/css/pedidos.css">
	<link rel="icon" href="static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home"><a href="home">		
					<img src="static/img/logomain.png" id="logo" alt="none">				
					<h1>FunkyTown</h1>
				</div></a>	
		</div>
	</div>
	<div class="contenido">
		<?php if($this->pedidos==false){ ?>
			<p>No se encontraron pedidos</p>
		<?php }else{ ?>
			<h2>Tus Pedidos</h2>
			<table>
				<tr>
					<th>ID</th>
					<th>Productos</th>
					<th>Fecha</th>
					<th>Estado</th>
				</tr>
					<?php foreach($this->pedidos as $p) { ?>
						<?php if($p['estado_id'] == 2){ ?>
						<tr id="<?=$p['id']?>" class="pedido_desp">
						<?php }elseif($p['estado_id'] == 1 || $p['estado_id'] == 0){?> 
						<tr id="<?=$p['id']?>" class="pedido">	
						<?php }elseif($p['estado_id'] == -1 || $p['estado_id'] == -2){?> 
						<tr id="<?=$p['id']?>" class="pedido_cancel">	
						<?php } ?>			
						<td><?=$p['id']?></td>
						<td><?=$p['descripcion']?></td>
						<td><?=$p['fecha']?></td>
						<td><?=$p['estado']?></td>					
					</tr>
				<?php } ?>
			</table>
		<?php } ?>
		<a href="user?id=<?=$_SESSION['USER']['id']?>">Volver</a>
	</div>
	<script type="text/javascript">
		"use strict";

		<?php foreach ($this->pedidos as $p) { ?>
			document.getElementById(<?=$p['id']?>).onclick = function(){
				window.location.href = "verpedido?id=<?=$p['id']?>";
			}
		<?php } ?>
	</script>
</body>
</html>