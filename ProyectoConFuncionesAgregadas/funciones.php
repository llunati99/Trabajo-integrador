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
function crearUsuario($datos, string $avatar) {
	return [
		"usuario" => $datos["usuario"],
		"contrasena" => password_hash($datos["contrasena"], PASSWORD_DEFAULT),
		"email" => $datos["email"],
		"nombre" => $datos["nombre"],
		"apellido" => $datos["apellido"],
		"avatar" => $avatar 								// Agregado nuevo!
	];
}
function guardarUsuario($usuario){
	$user = json_encode($usuario);
	file_put_contents("usuarios.json", $user, FILE_APPEND | LOCK_EX);
}

// ************* Funciones Nuevas *****************

function validacionAvatar($avatar) {
	$errorAvatar = [];
	if (empty($avatar)) {
		$errorAvatar["avatar"] = "Por favor ingrese su foto de perfil";
	}
	if ($avatar["error"] != UPLOAD_ERR_OK) {
		$errorAvatar["avatar"] = "Ocurrio un error al subir la foto, intente una vez mas.";
	}
	return $errorAvatar;
}

function chequeoDatosEnBase($datos) {
	$errorExiste = [];
	$json = file_get_contents("usuarios.json");
	$array = json_decode($json, true);
	var_dump($array["usuario"]);

	if ($datos["usuario"] == $array["usuario"]){
		$errorExiste["usuario"] = "Ya existe un usuario con ese nombre, por favor elija otro.";
	}
	if ($datos["email"] == $array["email"]){
		$errorExiste["email"] = "Ya existe un usuario con ese email, por favor ingrese un mail valido.";
	}
	return $errorExiste;
}

function subirAvatar($avatar){
    $nombreViejo = $avatar["name"]; // Nombre original del archivo
    $extension = pathinfo($nombreViejo, PATHINFO_EXTENSION); // Extensión del archivo subido
    $nombreNuevo = $avatar["tmp_name"]; // Nombre temporal en el servidor
    $archivoFinal = "\images\perfiles\\"; // .= nos permite concatenar, en este caso es lo mismo que poner $archivoFinal = $archivoFinal . "/img/"
    $archivoFinal .= uniqid() . "." . $extension; // uniqid genera un ID "único" para la foto

    $archivoFinalF = realpath(__DIR__ . '/..') . $archivoFinal; // Agarramos el archivo donde estamos parados ahora mismo
    move_uploaded_file($nombreNuevo, $archivoFinalF); // movemos el archivo a la ubicación final
    return ".".str_replace("\\","/",$archivoFinal);
}

?>
