<?php
include_once("funciones.php");
include_once("usuarios.json");
error_reporting(E_ALL ^ E_NOTICE);

$inputVacio = [];

if ($_POST) {
	$inputVacio = validarRegistro($_POST);
	if (empty($inputVacio)) {
		$nuevoUsuario = crearUsuario($_POST);
		guardarUsuario($nuevoUsuario);
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="container">
	<div class="header">
		<h1 class="titulo-principal">Registrate</h1>
	</div>
	<div class="caja-formulario">
		<form class="formulario" action="" method="post">
			<div>
				<legend class="titulo-formulario">Registrate en Todo Motos</legend>
			</div>
			<div class="texto-que-dice-gratis">	
				<h3 class="unico-h3">Es 100% gratis</h3>
			</div>
			<div class="datos-input">
				Nombre de usuario:
				<input class="input-usuario" type="text" name="usuario" value="<?php if($_POST["usuario"] == $_POST["usuario"]) { echo($_POST["usuario"]); } else  { echo " "; } ?>"><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["usuario"]) ? $inputVacio["usuario"]:"";?> </span>
			</div>			
			<div class="datos-input">
				Contraseña:			
				<input class="input-contraseña" type="password" name="contrasena" value=""><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["contrasena"]) ? $inputVacio["contrasena"]:"";?> </span>
			</div>
			<div class="datos-input">
				Confirmar contraseña:			
				<input class="input-confirm-contraseña" type="password" name="contrasena-confirm" value=""><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["contrasena-confirm"]) ? $inputVacio["contrasena-confirm"]:"";?> </span>
			</div>
			<div>
				Email:			
				<input class="input-email" type="email" name="email" value="<?php if($_POST["email"] == $_POST["email"]) { echo($_POST["email"]); } else  { echo " "; } ?>"><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["email"]) ? $inputVacio["email"]:"";?> </span>
			</div>
			<div class="datos-input">
				Confirmar email:			
				<input class="input-confirm-email" type="email" name="email-confirm" value=""><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["email-confirm"]) ? $inputVacio["email-confirm"]:"";?> </span>
			</div>
			<div class="datos-input">
				Nombre:			
				<input class="input-nombre" type="text" name="nombre" value="<?php if($_POST["nombre"] == $_POST["nombre"]) { echo($_POST["nombre"]); } else  { echo " "; } ?>"><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["nombre"]) ? $inputVacio["nombre"]:"";?> </span>
			</div>
			<div class="datos-input">
				Apellido:			
				<input class="input-apellido" type="text" name="apellido" value="<?php if($_POST["apellido"] == $_POST["apellido"]) { echo($_POST["apellido"]); } else  { echo " "; } ?>"><br>
				<span style="color: red;" class='error'><?php echo isset($inputVacio["apellido"]) ? $inputVacio["apellido"]:"";?> </span>
			</div>
			<div class="unico-checkbox">
				<input type="checkbox" name="terminos-y-condiciones"> He leido y acepto los <a href=""> términos y condiciones legales de Todo Motos </a><br>			
			</div>
			<div class="caja-boton-enviar">	
				<input class="boton-enviar" type="submit" name="enviar-formulario">
			</div>
			<div>
				<h4 class="unico-h4">¿Ya estas registrado? <a href="">Inicia sesión</a></h4>
			</div>
			<div>
				<h5><a href="index.html">Volver al inicio</a></h5>
			</div>
		</form>
	</div>
</body>
</html>