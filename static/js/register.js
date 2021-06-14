"use strict";

document.getElementById("return_home").onclick = function(){
	window.location.href = "home";
}

document.getElementById("btn_register").onclick = function(){
	/*VALIDACION*/

	let nomape = new RegExp('^[A-Za-zÀ-ÿ\u00f1\u00d1]|[A-Za-zÀ-ÿ\u00f1\u00d1]+[ ]{1,40}$');
	let dni = new RegExp('^[0-9]{8}$')
	let pass = new RegExp('^[A-Za-z0-9]{6,40}$');
	let regmail = new RegExp('^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,100}$');

	if(!nomape.test(document.getElementById("nom").value)){
		document.getElementById("error").innerHTML = "Ingrese un nombre valido";
		return false;
	}

	if(!nomape.test(document.getElementById("ape").value)){
		document.getElementById("error").innerHTML = "Ingrese un apellido valido";
		return false;
	}

	if(!dni.test(document.getElementById("dni").value)){
		document.getElementById("error").innerHTML = "Ingrese un DNI valido";
		return false;
	}

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

	if(document.getElementById('pass').value != document.getElementById('pass2').value){
		document.getElementById("error").innerHTML = "Las Contraseñas no coinciden";
		return false;
	}

}