<?php

  require_once 'clases/db.php';
  require_once 'clases/mysql.php';

  $conexion = new Mysql();
  $conexion->crearSchema();
  $conexion->insertarDataInicialEnSchema();

?>
