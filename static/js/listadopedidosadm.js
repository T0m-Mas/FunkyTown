"use strict";

var btn_filtrar = document.getElementById("filtrar");

var cmp_user = document.getElementById("nombreusuario");
var cmp_productos = document.getElementById("productos");
var cmp_fecha = document.getElementById("fecha");
var cmp_max = document.getElementById("limite");

var flg_user = false;
var flg_productos = false;
var flg_fecha = false;
var flg_max = false;

cmp_user.onchange = function(){
	flg_user = true;
}
cmp_productos.onchange = function(){
	flg_productos = true;
}
cmp_fecha.onchange = function(){
	flg_fecha = true;
}
cmp_max.onchange = function(){
	flg_max = true;
}

btn_filtrar.onclick = function(){
	if(!flg_user && !flg_productos && !flg_fecha && !flg_max){
		window.alert("Complete al menos un campo antes de filtrar")
		return false;
	}
} 