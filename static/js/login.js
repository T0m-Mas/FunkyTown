"use strict";

document.getElementById("return_home").onclick = function(){
	window.location.href = "home";
}

document.getElementById("btn_login").onclick = function(){
	/*VALIDACION*/

	let pass = new RegExp('^[A-Za-z0-9]{6,40}$');
	let regmail = new RegExp('^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$');

	if(!regmail.test(document.getElementById('user').value)){
		document.getElementById("error").innerHTML = "Email no valido";
		return false;
	}

	if(((document.getElementById('pass').value).length >40 ||((document.getElementById('pass').value).length <6))){
		document.getElementById("error").innerHTML = "La Contraseña debe ser de 6 a 40 caracteres de longiud";
		return false;
	}

	if(!pass.test(document.getElementById('pass').value)){
		document.getElementById("error").innerHTML = "La Contraseña solo puede contener letras y numeros";
		return false;
	}
	



}
