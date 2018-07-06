<?php
// require_once 'db.php';

class Mysql extends DB {

  // Variable para manejar la base de datos internamente en el objeto
  private $db;

  // Constructor para generar la conexión
  public function __construct() {
    $dsn = "mysql:host=localhost;charset=utf8mb4";
    $usuario = "root";
    $password = "";

    // Fijarse que en este caso, el constructor está seteando la variable $this->db para usar como base de datos.
    $this->db = new PDO($dsn, $usuario, $password);
  }

  // Crear base de datos --- Preguntar si todo esto va aca...
  public function crearSchema(){
    $sql = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
    SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
    SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

    CREATE SCHEMA IF NOT EXISTS `moto_market` DEFAULT CHARACTER SET latin1 ;
    USE `moto_market` ;


    CREATE TABLE IF NOT EXISTS `moto_market`.`cilindrados` (
      `cilindrado_id` INT(11) NOT NULL,
      `cilindrado` VARCHAR(100) NOT NULL,
      PRIMARY KEY (`cilindrado_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = latin1;


    CREATE TABLE IF NOT EXISTS `moto_market`.`estilos` (
      `estilos_id` INT(11) NOT NULL AUTO_INCREMENT,
      `estilo` VARCHAR(100) CHARACTER SET 'latin1' NOT NULL,
      PRIMARY KEY (`estilos_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;

    CREATE TABLE IF NOT EXISTS `moto_market`.`marcas` (
      `marca_id` INT(11) NOT NULL AUTO_INCREMENT,
      `nombre` VARCHAR(100) NOT NULL,
      PRIMARY KEY (`marca_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = latin1;

    CREATE TABLE IF NOT EXISTS `moto_market`.`motos` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `anio` DATE NOT NULL,
      `precio` INT(11) NOT NULL,
      `estilo_id` VARCHAR(45) NOT NULL,
      `cilindrado_id` VARCHAR(45) NOT NULL,
      `marca_id` VARCHAR(45) NOT NULL,
      PRIMARY KEY (`id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = latin1;

    CREATE TABLE IF NOT EXISTS `moto_market`.`usuarios` (
      `id_usuarios` INT(11) NOT NULL AUTO_INCREMENT,
      `usuario` VARCHAR(45) NOT NULL,
      `password` VARCHAR(100) NOT NULL,
      `email` VARCHAR(45) NOT NULL,
      `nombre` VARCHAR(45) NOT NULL,
      `apellido` VARCHAR(45) NOT NULL,
      `ruta_avatar` VARCHAR(100) NULL DEFAULT NULL,
      PRIMARY KEY (`id_usuarios`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARACTER SET = latin1;

    SET SQL_MODE=@OLD_SQL_MODE;
    SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
    SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";

    $this->db->prepare($sql)->execute();
  }

  // Crear base de datos -- Preguntar si esta bien poner el schema al lado de la tabla...
  public function insertarDataInicialEnSchema(){
    $sql = "INSERT INTO moto_market.usuarios (usuario, password, email, nombre, apellido, ruta_avatar) VALUES ('Valen13', '$2y$10\$qf6VYsFmsKP5jnbuMonYMeYkNXXDU1Rhz2FHS7ayYpO/82ATX/x5S', 'valentinsanchezm@hotmail.com', 'Valentin', 'Mariño', 'C:\xampp\htdocs\Prueba\ProyectoConFuncionesAgregadas/images/perfiles/5b3dad65b6e90.jpg');
            INSERT INTO moto_market.usuarios (usuario, password, email, nombre, apellido, ruta_avatar) VALUES ('monty15', '$2y$10\$rYwEXX3AjtZYYbWb9HjsT.V5sBiDmi3bb7ldCPbvqOhGdA8VRWJY6', 'monty@gmail.com', 'Monty', 'Hola', 'C:\xampp\htdocs\Prueba\ProyectoConFuncionesAgregadas/images/perfiles/5b3dad959ec8b.jpg');";

    $this->db->prepare($sql)->execute();
  }



  // ********************************
  // ** Transacciones de usuarios  **
  // ********************************


  // Usamos la funcion guardarUsuario para guardar el usuario con un comportamiento difrente al de Json pero que igualmente se llama usando $conexión->guardarUsuario()
  public function guardarUsuario(Usuario $usuario) {

    // Generamos una variable donde guardamos la query
    $sql = "INSERT INTO moto_market.usuarios (usuario, password, email, nombre, apellido, ruta_avatar) VALUES (:usuario, :password, :email, :nombre, :apellido, :rutaAvatar)";

    // Preparamos la query
    $query = $this->db->prepare($sql);

    // Bindeamos los parámetros
    $query->bindParam(":usuario", $usuario->getUsuario());
    $query->bindParam(":password", $usuario->getPassword());
    $query->bindParam(":email", $usuario->getEmail());
    $query->bindParam(":nombre", $usuario->getNombre());
    $query->bindParam(":apellido", $usuario->getApellido());
    $query->bindParam(":rutaAvatar", $usuario->getRutaAvatar());

    $query->execute();
  }

  public function verificaUsuarioLogin($usuario){
    $sql = "SELECT u.password, u.nombre, u.apellido, u.ruta_avatar FROM moto_market.usuarios as u WHERE u.usuario = :usuario";

    $query = $this->db->prepare($sql);

    $query->bindParam(':usuario', $usuario, PDO::PARAM_STR);

    $query->execute();
    return $query->fetch();
  }

  public function validarExisteUsuarioEmail(Usuario $usuario) {
      $sql = "SELECT u.usuario, u.email FROM moto_market.usuarios as u WHERE u.email = :email OR u.usuario = :usuario";

      $query = $this->db->prepare($sql);

      $query->bindParam(':email', $usuario->getEmail(), PDO::PARAM_STR);
      $query->bindParam(':usuario', $usuario->getUsuario(), PDO::PARAM_STR);

      $query->execute();
      return $query->fetch();
  }
}


 ?>
