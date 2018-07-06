<?php

  class Motos {
    private $id;
    private $anio;
    private $precio;
    private $estilo_id;
    private $cilindrado_id;
    private $marca_id;

    function __construct($id, $anio, $precio, $estilo_id, $cilindrado_id, $marca_id) {
      $this->id = $id;
      $this->anio = $anio;
      $this->precio = $precio;
      $this->estilo_id = $estilo_id;
      $this->cilindrado_id = $cilindrado_id;
      $this->marca_id = $marca_id;
    }
  }









 ?>
