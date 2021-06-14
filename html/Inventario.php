<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inventario de Productos</title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/adm.css">
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
		<div class="listado">
			<?php foreach($this->productos as $p){ ?>			
			<p><span class="titulo"><?=$p['titulo']?></span>
			<a href="modificarproducto?id=<?=$p['id']?>">Modificar</a>
			<a href="stock?id=<?=$p['id']?>">Ver Stock</a>
			<?php } ?>
			</p>
		</div>

		<a href="../admin">Volver</a>
	</div>

</body>
</html>