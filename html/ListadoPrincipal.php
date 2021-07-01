<!DOCTYPE html>
<html>
<head>
	<title>Listado De Productos</title>
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/listado.css">
	<link rel="icon" href="static/img/icono.ico" type="image/x-icon">
</head>
<body>
	<div class="fondobanner">
		<div class="banner">
				<div id="return_home">		
					<img src="static/img/logomain.png" id="logo" alt="none">				
					<h1>FunkyTown</h1>
				</div>
				<?php if($_SESSION['logeado']){ ?>
					<div class="go_chango">
						<a href="carrito">
						<?php if(isset($_SESSION['carrito'])){ ?>
								<img src="static/img/chango_on.png" alt="none">
							<?php }else{ ?>
								<img src="static/img/chango_off.png" alt="none">
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
								<option value="<?=$c['id']?>"><?=$c['descripcion']?></option><?php
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

	<?php 
		$count = 0;
		$pag = 0; 
	?>	

	<div class="contenido">
		<div class="pagina" id="pag_<?=$pag?>">
		<?php foreach($this->productos as $p){ ?>
			<?php if($p['stock']==0){ ?>		
			<a href="catalogo/producto?id=<?=$p['id']?>" class="producto_agotado">
			<?php }else{ ?>
			<a href="catalogo/producto?id=<?=$p['id']?>" class="producto">
			<?php } ?>
				<?php 
					if($p['img']==null){
					echo '<img src="static/img/noimage.png" alt="none" />'; 
					}
					else{
						echo '<img src="data:image/jpeg;base64,'.base64_encode($p['img'] ) .'" alt="none" />'; 
					}
				?>
				<h2>
					<?=$p['titulo']?>						
				</h2>
				<p>					
					<?php if($p['stock']==0){ ?>
					AGOTADO
					<?php }else{ ?>
					$<?=$p['precio_venta']?>
					<?php } ?>
				</p>
			</a>
			<?php $count++ ?>
			<?php if($count==9){		
				echo '</div>';
				ob_flush();
				$pag++;
				ob_start();
				echo '<div class="pagina_hide" id="pag_'.$pag.'">';
				$count = 0;
			} ?>
			<?php } ?>
			<?php if($count != 0){
				echo '</div>';
		} ?>

		<?php if($count==0) {
			ob_clean();
			$pag--;
		}?>


		<div class="index">
			<img src="static/img/btnizq.png" class="indexbtn" id="btnpag-" alt="none">
			<span class="indexvisr"><span id="pagactual"></span> / <span><?=$pag+1?></span></span>
			<img src="static/img/btnder.png" class="indexbtn" id="btnpag+" alt="none">
		</div>
	</div>
	<script src="static/js/listado.js"></script>
	<script type="text/javascript">

	"use strict";

	var pag_select = document.getElementById("pag_0");
	var pagnum = 0;
	var btnsig = document.getElementById("btnpag+");
	var btnant = document.getElementById("btnpag-");
	var pagactualvisor = document.getElementById("pagactual");
	pagactualvisor.innerHTML = 1;

	btnsig.onclick = function(){		
		pagnum++;
		if(pagnum><?=$pag?>) {
			pagnum--;
			return false;
		}
		pag_select.className = "pagina_hide";
		pag_select = document.getElementById("pag_"+pagnum);
		pag_select.className = "pagina";
		pagactualvisor.innerHTML = pagnum+1;
		
	}

	btnant.onclick = function(){
		pagnum--;
		if(pagnum<0) {
			pagnum++;
			return false;
		}
		pag_select.className = "pagina_hide";
		pag_select = document.getElementById("pag_"+pagnum);
		pag_select.className = "pagina";
		pagactualvisor.innerHTML = pagnum+1;
	}



	</script>
</body>
</html>