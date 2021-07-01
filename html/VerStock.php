<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stock <?=$this->producto['titulo']?></title>
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
		<div class="campo">
			<p><?=$this->producto['titulo']?></p>	
			<p><?=$this->producto['descripcion']?></p>
			<p>$<?=$this->producto['precio_venta']?></p>
		</div>

			<table>
				<tr><th>TALLE</th><th>CANTIDAD</th><th>RESERVADO</th><th>OPERACION</th></tr>
				<?php foreach($this->stock as $s) { ?>
				<tr>
					<td><?=$s['talle']?></td>
					<td><?=$s['cantidad']?></td>
					<td><?=$s['reserva']?></td>
					<td>
						<form method="POST" class="stock">
							<input type="number" name="nuevostock" min="0" class="number" value="0">
							<input type="hidden" name="talle" value="<?=$s['talle']?>">
							<input type="submit" name="stock+" class="btnstock" value="+">
							<input type="submit" name="stock-" class="btnstock" value="-">
							<input type="submit" name="stock=" class="btnstock" value="=">
						</form>
					</td>
				</tr>
				<?php } ?>
			</table>
			<p id="error"><?=$this->error?></p>
		<a href="inventario">Volver</a>
	</div>
</body>
</html>