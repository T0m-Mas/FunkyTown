"use strict";

document.getElementById("talle").onchange = function(){

	var cantidad = document.getElementById("cantidad");
	var max = document.getElementById("max"+document.getElementById("talle").value);
	cantidad.value = "1";
	cantidad.max = max.value;
}

document.getElementById("btn_agregar").onclick = function(){
	var error = document.getElementById("error");
	if(document.getElementById("talle").value == ""){
		error.innerHTML = "Por favor complete los campos";
		return false;
	}
	if(document.getElementById("cantidad").value == "" || document.getElementById("cantidad") == "0"){
		error.innerHTML = "Por favor complete los campos";
		return false;
	}
}