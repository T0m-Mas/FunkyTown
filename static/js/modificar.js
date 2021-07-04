"use strict";

var categoria = document.getElementById("nuevacategoria").value;

document.getElementById("guardar").onclick = function(){
	
	var error = document.getElementById("error");

	if(document.getElementById("nuevotitulo").value==""){
		error.innerHTML = "Ingrese un titulo";
		return false;
	}

	if(document.getElementById("nuevadescripcion").value==""){
		error.innerHTML = "Ingrese una descripcion";
		return false;
	}

	if(document.getElementById("nuevoprecio").value==""){
		error.innerHTML = "Ingrese un precio";
		return false;
	}

	let precio = new RegExp("^[0-9]+\.?[0-9]*$");

	if(!precio.test(document.getElementById("nuevoprecio").value)){
		error.innerHTML = "Ingrese un precio valido";
		return false;
	}

	if(categoria!=document.document.getElementById("nuevacategoria").value){
		if(!confirm("Si cambia la categoria se eliminara el stock\n¿Continuar?")){
			return false;
		}
	}
}

document.getElementById("eliminar").onclick = function(){
	if(!confirm("¿Esta seguro que desea eliminar este producto?")){
		return false;
	}
}

document.getElementById("btnfoto").onclick = function(){
	document.getElementById("inputfile").click();		
}
document.getElementById("inputfile").onchange = function(){
	document.getElementById("btnfoto").src = "../static/img/yesimage.png";
}