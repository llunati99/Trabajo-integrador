<?php

// Creamos una clase abstracta para obligar a nuestras clases hijas a implementar los métodos
abstract class DB {
  abstract protected function guardarUsuario(Usuario $usuario);
}


 ?>
