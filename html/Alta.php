<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta de producto</title>
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
		<h2>Alta de un producto</h2>
		<form method="POST" enctype="multipart/form-data">
			<div class="campo">
				<label for="titulo">Titulo:</label>
				<input type="text" name="titulo" id="titulo">
			</div>
			<div class="campo">
				<label for="descripcion">Descripcion:</label>
				<textarea name="descripcion" id="descripcion" rows=10></textarea>
			</div>
			<div class="campo">
				<label for="categoria">Categoria:</label>
				<select name="categoria" >
				<?php foreach($this->categorias as $c) { ?>
				<option value="<?=$c['id']?>"><?=$c['descripcion']?></option> <?php } ?>
				</select>
			</div>
			<div class="campo">
				<label for="precio">Precio Venta:</label>
				<input type="text" name="precio" id="precio">
			</div>
			<div class="campo">
				<label for="imagen">Imagen Ilustrativa:</label>
				<input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg" multiple="false">
			</div>
			<input type="submit" name="guardar" id="submit" value="Guardar">
		</form>
	</div>

</body>
</html>