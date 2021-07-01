<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modificar <?=$this->producto['titulo']?></title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/adm.css">
	<link rel="icon" href="../static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home"><a href="../home">		
					<img src="../static/img/logomain.png" id="logo" alt="none">				
					<h1>FunkyTown</h1>
				</a></div>
				<a href="../admin" class="boton">Panel Admin</a>		
		</div>
	</div>
	<div class="contenido">
		<?php 
			if($this->producto['img']==null){
			echo '<img src="../static/img/noimage.png" id="btnfoto" alt="none" />'; 
			}
			else{
				echo '<img src="data:image/jpeg;base64,'.base64_encode($this->producto['img'] ) .'" id="btnfoto" alt="none" />'; 
			}
		?>
		<form method="POST" enctype="multipart/form-data">
		<input type="file" name="nuevafoto" id="inputfile">	
			<div class="campo">
				<label for="nuevotitulo" class="lbl2">Titulo:</label>
				<input type="text" id="nuevotitulo" name="nuevotitulo" value="<?=$this->producto['titulo']?>">
			</div>

			<div class="campo">
				<label for="nuevadescripcion" class="lbl2">Descripcion:</label>
				<textarea name="nuevadescripcion" id="nuevadescripcion"><?=$this->producto['descripcion']?></textarea>
			</div>
			
			<div class="campo">
				<label for="nuevacategoria" class="lbl2">Categoria:</label>
				<select name="nuevacategoria" id="nuevacategoria">
					<?php foreach($this->categorias as $c) { ?>
						<?php if($c['id'] == $this->producto['id_categoria']){ ?>						
							<option value="<?=$c['id']?>" selected ><?=$c['descripcion']?></option>
						<?php }else{ ?>
							<option value="<?=$c['id']?>"><?=$c['descripcion']?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
			<div class="campo">
				<label for="nuevoprecio" class="lbl2">Precio:</label>
				<input type="text" name="nuevoprecio" id="nuevoprecio" value="<?=$this->producto['precio_venta']?>">
			</div>
			<div class="botones">
				<input type="submit" name="eliminar" id="eliminar" value="Eliminar Este Producto">
				<input type="submit" name="guardar" id="guardar" value="Guardar Cambios">
			</div>
		</form>
		
		<a href="../admin">Volver...</a>
	</div>
	<script src="../static/js/modificar.js"></script>
</body>
</html>