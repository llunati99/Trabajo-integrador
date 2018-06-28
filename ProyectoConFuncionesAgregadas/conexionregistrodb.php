<!-- php para que el registro vaya a base de datos
TERMINADOOOOOOO LOCO ATR  !-->
<?php

$user = "root";
$contra = "";
try
{$mdb = new PDO('mysql:host=localhost;dbname=moto_market', $user, $contra);

$stmt = $mdb->prepare("INSERT INTO usuarios (usuario, password, email, nombre, apellido) VALUES (:usuario, :password, :email, :nombre, :apellido)");

$usuariodb = $_POST["usuario"];
$contra = $_POST["contrasena"];
$mail = $_POST["email"];
$nom = $_POST["nombre"];
$ape = $_POST["apellido"];

$stmt->bindParam(':usuario',$usuariodb,PDO::PARAM_STR);
$stmt->bindParam(':password',$contra,PDO::PARAM_STR);
$stmt->bindParam(':email',$mail,PDO::PARAM_STR);
$stmt->bindParam(':nombre',$nom,PDO::PARAM_STR);
$stmt->bindParam(':apellido',$ape,PDO::PARAM_STR);
$stmt->execute();
print_r($stmt->errorInfo());
exit;
}


catch(PDOException $e){
echo $e->getMessage();
};
 ?>
