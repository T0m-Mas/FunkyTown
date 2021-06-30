<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de Pedidos</title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/adm.css">
	<link rel="stylesheet" type="text/css" href="../static/css/pedidos.css">
	<link rel="stylesheet" type="text/css" href="../static/css/pedidos.css">
	<link rel="icon" href="../static/img/icono.ico" type="image/x-icon">
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
		<div class="filtro">
			<?php if(isset($_POST['filtrar'])){ ?>
				<form method="POST">
				<label for="nombreusuario">Usuario:</label>
				<input type="text" id="nombreusuario" name="nombreusuario" value="<?=$_POST['nombreusuario']?>">
				<label for="productos">Productos:</label>
				<input type="text" id="productos" name="productos" value="<?=$_POST['productos']?>">
				<label for="fecha">Fecha:</label>
				<input type="date" id="fecha" name="fecha" value="<?=$_POST['fecha']?>">
				<label for="limite">Max:</label>
				<input type="number" name="limite" id="limite" value="<?=$_POST['limite']?>">
				<input type="submit" name="filtrar" value="Filtrar" id="filtrar">
				</form>	
			<?php }else{ ?>
			<form method="POST">
				<label for="nombreusuario">Usuario:</label>
				<input type="text" id="nombreusuario" name="nombreusuario">
				<label for="productos">Productos:</label>
				<input type="text" id="productos" name="productos">
				<label for="fecha">Fecha:</label>
				<input type="date" id="fecha" name="fecha">
				<label for="limite">Max:</label>
				<input type="number" name="limite" id="limite" value="50">
				<input type="submit" name="filtrar" value="Filtrar" id="filtrar">				
			</form>	
			<?php } ?>
			<form method="POST">
				<label for="id">Buscar por ID:</label>
				<input type="number" name="id" id="id">
				<input type="submit" name="buscar" value="Buscar" id="buscar">
				<?php if(isset($_POST['filtrar'])){ ?>
					<a href="listadopedidosadm" id="reset">Limpiar Filtros</a>
				<?php } ?>
			</form>
		</div>
		<?php if($this->pedidos == false) { ?>
			<p>No se encontraron pedidos</p>
		<?php }else{ ?>
			<table>
				<tr>
					<th>ID</th>
					<th>Usuario</th>
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
						<td><?=$p['nombre']?></td>
						<td><?=$p['descripcion']?></td>
						<td><?=$p['fecha']?></td>
						<td><?=$p['estado']?></td>					
					</tr>
				<?php } ?>
			</table>
		<?php } ?>
	</div>
</body>
<script type="text/javascript">
	"use strict";

	<?php foreach ($this->pedidos as $p) { ?>
		document.getElementById(<?=$p['id']?>).onclick = function(){
			window.location.href = "verpedidoadm?id=<?=$p['id']?>";
		}
	<?php } ?>

	<?php if($this->alert != false) { ?>
		window.alert("<?=$this->alert?>");
	<?php } ?>

</script>
<script src="../static/js/listadopedidosadm.js"></script>
</html>