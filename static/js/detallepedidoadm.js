"use strict";

var btn_cancelar = document.getElementById("cancelar");
var btn_despachar = document.getElementById("despachar");

btn_cancelar.onclick = function(){
	if(!confirm("¿Esta seguro que desea cancelar este pedido?\nEsta opcion no se puede deshacer")){
		return false;
	}
}
btn_despachar.onclick = function(){
	if(!confirm("¿Esta seguro que desea despachar este pedido?\nEsta opcion no se puede deshacer")){
		return false;
	}
}