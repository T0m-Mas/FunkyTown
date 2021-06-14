"use strict";

var categoria = document.getElementById("nuevacategoria").value;

document.getElementById("guardar").onclick = function(){
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