<?php
// require_once 'db.php';

// Creamos la clase JSON
class Json extends DB {
	// Como vamos a trabajar siempre con el mismo archivo, creamos una variable con el nombre y nos referimos al mismo utilizando la constante
	const ARCHIVO = "usuarios.json";

	// Función para guardar usuarios con typehinting para obligar a recibir un objeto del tipo usuario
	public function guardarUsuario(Usuario $usuario) {

		// Generamos un array en el cual guardamos las diferentes propiedades de nuestro usuario
		$usuarioFinal = [];
		$usuarioFinal["nombre"] = $usuario->getNombre();
		$usuarioFinal["usuario"] = $usuario->getUsuario();
		$usuarioFinal["email"] = $usuario->getEmail();
		$usuarioFinal["password"] = $usuario->getPassword();

		// Guardamos el usuario en nuestro archivo JSON, usando la constante ARCHIVO (usando la palabra self para referirse al objeto, de la misma forma que usabamos $this) como nombre del archivo. Le agregamos PHP_EOL al json_encode() para que se inserte un salto de linea.
		file_put_contents(self::ARCHIVO, json_encode($usuarioFinal) . PHP_EOL, FILE_APPEND);
	}
}

?>
