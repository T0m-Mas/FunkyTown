<!DOCTYPE html>
<html>
<head>
	<title>Listado De Productos</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/listado.css">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo">				
					<h1>FunkyTown</h1>
				</div>
				<?php if($_SESSION['logeado']){ ?>
					<div class="go_chango">
						<a href="carrito">
						<?php if(isset($_SESSION['carrito'])){ ?>
								<img src="static/img/chango_on.png">
							<?php }else{ ?>
								<img src="static/img/chango_off.png">
							<?php } ?>
						</a>
					</div>
				<?php } ?>
			<div class="menu">
				<div class="menu_contenido">
					<form name="buscador_productos">
						<span class="boton">
							<input type="text" name="buscador" class="search">
							<input type="submit" name="buscar" class="submit" value="Buscar">
						</span>
					</form>
					<form name="selector_categoria">
						<span class="boton">
							<select name="categoria" id="categoria">
								<option value="" selected disabled="">Categorias...</option>
							<?php foreach ($this->categorias as $c) { ?>
								<option value="<?=$c['id']?>"><a href="aaa"><?=$c['descripcion']?></a></option><?php
							} ?>
								<option value="0">Ver Todo</option>
							</select>
						</span>
					</form>
				</div>
				<div class="menu_usuario">
					<?php if(!$_SESSION['logeado']){ ?>
						<a href="login" id="blogin" class="boton">Iniciar Sesion/Registrarse</a>
					<?php }else{ ?> 
						<?php if($_SESSION['privilegios']){ ?>
							<a href="admin" class="boton">Panel Admin</a>
						<?php }else {?>
							<a href="user?id=<?=$_SESSION['USER']['id']?>" class="boton">Hola <?=$_SESSION['USER']['nombre']?>!</a>
						<?php } ?>
						<a href="logout" id="blogout" class="boton">Cerrar Sesion</a>
					<?php } ?>			
				</div>
			</div>
		</div>
	</div>	

	<div class="contenido">
		<?php foreach($this->productos as $p){ ?>
			<td>
				<a href="catalogo/producto?id=<?=$p['id']?>">
					<?php 
						if($p['img']==null){
							echo '<img src="static/img/noimage.png" />'; 
						}
						else{
							echo '<img src="data:image/jpeg;base64,'.base64_encode($p['img'] ) .'" />'; 
						}
					?>
					<h2><?=$p['titulo']?></h2>
					<p><?=$p['descripcion']?></p>
					<p>$<?=$p['precio_venta']?></p>
				</a>
			</td>
			<?php } ?>
		</table>
	</div>
</body>
<script src="static/js/listado.js"></script>
</html>