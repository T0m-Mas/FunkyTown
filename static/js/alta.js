"use strict";

document.getElementById("submit").onclick = function(){

	var error = document.getElementById("error");

	if(document.getElementById("titulo").value==""){
		error.innerHTML = "Ingrese un titulo";
		return false;
	}

	if(document.getElementById("descripcion").value==""){
		error.innerHTML = "Ingrese una descripcion";
		return false;
	}

	if(document.getElementById("precio").value==""){
		error.innerHTML = "Ingrese un precio";
		return false;
	}

	let precio = new RegExp("^[0-9]+\.?[0-9]*$");

	if(!precio.test(document.getElementById("precio").value)){
		error.innerHTML = "Ingrese un precio valido";
		return false;
	}



}