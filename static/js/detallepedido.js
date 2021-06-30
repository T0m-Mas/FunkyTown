"use strict";

var btn_cancelar = document.getElementById("cancelar");

btn_cancelar.onclick = function(){
	if(!confirm("¿Esta seguro que desea cancelar este pedido?\nEsta opcion no se puede deshacer")){
		return false;
	}
}