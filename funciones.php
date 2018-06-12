<?php

function validarRegistro($datos){
	$inputVacio = [];
	if ($datos["usuario"] == "") {
		$inputVacio["usuario"] = "Por favor ingrese su usuario";
	}
	if ($datos["contrasena"] == "") {
		$inputVacio["contrasena"] = "Por favor ingrese su contraseña";
	} elseif (strlen($datos["contrasena"]) < 6) {
		$inputVacio["contrasena"] = "La contraseña debe ser mayor a 6 caracteres";
	}
		if ($datos["contrasena-confirm"] == "") {
		$inputVacio["contrasena-confirm"] = "Por favor reingrese su contraseña";
	} elseif ($datos["contrasena-confirm"] !== $datos["contrasena"]) {
		$inputVacio["contrasena-confirm"] = "Sus contraseñas no coinciden";
	}
		if ($datos["email"] == "") {
		$inputVacio["email"] = "Por favor ingrese su email";
	}	elseif (!filter_var($datos["email"],FILTER_VALIDATE_EMAIL)) {
   		$inputVacio["email"] = "Por favor ingrese un email valido";
   	}
		if ($datos["email-confirm"] == "") {
		$inputVacio["email-confirm"] = "Por favor reingrese su email";
	}	elseif ($datos["email-confirm"] !== $datos["email"]) {
		$inputVacio["email-confirm"] = "Sus emails no coinciden";
	}
		if ($datos["nombre"] == "") {
		$inputVacio["nombre"] = "Por favor ingrese su nombre";
	}
		if ($datos["apellido"] == "") {
		$inputVacio["apellido"] = "Por favor ingrese su apellido";
	}

	return $inputVacio;
}
function crearUsuario($datos) {
	return [
		"usuario" => $datos["usuario"],
		"contrasena" => password_hash($datos["contrasena"], PASSWORD_DEFAULT),
		"email" => $datos["email"],
		"nombre" => $datos["nombre"],
		"apellido" => $datos["apellido"]
	];
}
function guardarUsuario($usuario){
	$user = json_encode($usuario);
	file_put_contents("usuarios.json", $user, FILE_APPEND | LOCK_EX);
}
?>
