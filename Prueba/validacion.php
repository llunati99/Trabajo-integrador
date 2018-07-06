<?php

// Hoja Nueva --- (Podria ser anexada a funciones.php tal vez!)

session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: bienvenido.php');						// Si la session trae algo redirige a bienvenido.php
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  require('conexionregistrodb.php');
  $consulta = $conexion -> prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password');
  $consulta -> execute(array(':usuario' => $usuario, ':password' => $password));

  $resultado = $consulta -> fetch();
  if ($resultado !== false) {
    $_SESSION['usuario'] = $usuario;
    header('Location: bienvenido.php');
  } else {
    header('Location: registro.php');
  }
}

// Lo saque de este video: https://www.youtube.com/watch?v=7_FR-xcJ2JM


 ?>
