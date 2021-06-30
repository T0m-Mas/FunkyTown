<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$this->producto['titulo']?></title>
	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../static/css/verproducto.css">
	<link rel="icon" href="../static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="../static/img/logomain.png" id="logo">				
					<h1>FunkyTown</h1>
				</div>
				<?php if($_SESSION['logeado']){ ?>
					<div class="go_chango">
						<a href="../carrito">
							<?php if(isset($_SESSION['carrito'])){ ?>
								<img src="../static/img/chango_on.png">
							<?php }else{ ?>
								<img src="../static/img/chango_off.png">
							<?php } ?>
						</a>
					</div>
				<?php } ?>
			<div class="menu">
				<div class="menu_contenido">
					<a href="../catalogo" class="boton">Volver al catalogo</a>
				</div>
				<div class="menu_usuario">
					<?php if(!$_SESSION['logeado']){ ?>
						<a href="../login" id="blogin" class="boton">Iniciar Sesion/Registrarse</a>
					<?php }else{ ?> 
						<?php if($_SESSION['privilegios']){ ?>
							<a href="../admin" class="boton">Panel Admin</a>
						<?php }else {?>
							<a href="../user?id=<?=$_SESSION['USER']['id']?>" class="boton">Hola <?=$_SESSION['USER']['nombre']?>!</a>
						<?php } ?>
						<a href="../logout" id="blogout" class="boton">Cerrar Sesion</a>
					<?php } ?>			
				</div>
			</div>
		</div>
	</div>
	<div class="contenido">	

		<?php 
		if($this->producto['img']==null){
		echo '<img src="../static/img/noimage.png" />'; 
		}
		else{
			echo '<img src="data:image/jpeg;base64,'.base64_encode($this->producto['img'] ) .'" />'; 
		}
		?>

		<h2><?=$this->producto['titulo']?></h2>		
		<p><?=$this->producto['descripcion']?></p>
		<p>$<?=$this->producto['precio_venta']?></p>

		<?php if(!$this->agotado){ ?>
		<form name="pedido" method="POST">
			<?php if($this->producto['id_categoria']==5) {?>
				<label for="cantidad">Cantidad:</label>
				<input type="number" name="cantidad" id="cantidad" min=1 max=<?=$this->talles[0]['cantidad']?> value="1">
				<input type="hidden" name="talle" id="talle" value="<?=$this->talles[0]['talle']?>">
				<?php }else{ ?>
					<div class="campo">
						<label for="talle">Talles:</label>
						<select name="talle" id="talle">
							<option value="" selected disabled>--</option>
							<?php foreach($this->talles as $t){ ?>
								<option value="<?=$t['talle']?>"><?=$t['talle']?></option>
							<?php } ?>
						</select>
					</div>
					<div class="campo">
						<label for="cantidad">Cantidad:</label>
						<input type="number" name="cantidad" id="cantidad" min=1 max=1>
						<?php if($this->producto['id_categoria']!=5) foreach($this->talles as $t){ ?>
							<input type="hidden" id="max<?=$t['talle']?>" value="<?=$t['cantidad']?>">
						<?php } ?>
					</div>
			<?php } ?>			 
			<p id="error"><?=$this->error?></p><input type="submit" name="agregar" id="btn_agregar" value="Agregar Al Carrito">
		</form>
		<?php }else{ ?>
			<p>Producto Agotado :(</p>
		<?php } ?>
	</div>
</body>
<script src="../static/js/verproducto.js"></script>
</html>