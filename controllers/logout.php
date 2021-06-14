<?php
session_start();
$_SESSION["logeado"] = false;
$_SESSION["privilegios"] = false;
unset($_SESSION["USER"]);
unset($_SESSION["carrito"]);
header("location: home");