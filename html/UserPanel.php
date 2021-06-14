<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Panel de usuario</title>
</head>
<body>
	<a href="pedidos.php">Mis Pedidos</a>
	<a href="pedidos.php">Configuracion</a>
	<?php if($_SESSION['USER']['privilegio']==1){ ?>
		<a href="paneladmin.php">Panel de Administrador</a>
	<?php } ?>
</body>
</html>