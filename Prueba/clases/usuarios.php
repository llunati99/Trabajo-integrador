<?php

class Usuario {
  private $usuario;
  private $password;
  private $email;
  private $nombre;
  private $apellido;
  private $rutaAvatar;

  function __construct($usuario, $password, $email, $nombre, $apellido) {
    $this->usuario = $usuario;
    $this->setPassword($password);
    $this->email = $email;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

	public function getUsuario(){
		return $this->usuario;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

  public function getRutaAvatar(){
    return $this->rutaAvatar;
  }

  public function setRutaAvatar($rutaAvatar){
    $this->rutaAvatar = $rutaAvatar;
  }

  // Se setea la contraseña, hasheandola primero
  public function setPassword($password) {
    $this->password = $this->hashPassword($password);
  }

  // Hasheamos la contraseña con un método privado, solo accesible desde DENTRO del objeto.
  private function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
?>
