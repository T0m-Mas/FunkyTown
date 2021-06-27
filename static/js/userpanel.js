"use strict";

var btnshow = document.getElementById("show");
var stats = document.getElementById("stats");

btnshow.onclick = function(){
	if(stats.style.display == "block"){ //oculto
		btnshow.innerHTML = 'Mostrar Estadisticas';
		stats.style.display = 'none';
	}else{
		btnshow.innerHTML = 'Ocultar Estadisticas';
		stats.style.display = 'Block';
	}
}

document.getElementById("return_home").onclick = function(){
	window.location.href = "home";
}