"use strict";

var currdisplay = document.getElementById("nosotros"); //la seccion que se muestra primero en el home

document.getElementById("bcontacto").onclick = function(){
	currdisplay.style.display = "none";
	currdisplay = document.getElementById("contacto");
	currdisplay.style.display = "block";
}
document.getElementById("bnosotros").onclick = function(){
	currdisplay.style.display = "none";
	currdisplay = document.getElementById("nosotros");
	currdisplay.style.display = "block";
}