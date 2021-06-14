"use strict";

document.getElementById("return_home").onclick = function(){
	window.location.href = "home";
}

document.getElementById("categoria").onchange = function(){
	document.forms["selector_categoria"].submit();
}


