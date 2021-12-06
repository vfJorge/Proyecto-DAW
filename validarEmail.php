<?php

include("funciones.php");
include("variablesbd.php");

$email = $_REQUEST["email"];

$email = filter_var($email, FILTER_SANITIZE_EMAIL);



$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
if (!$conexion) {
    die("Fallo: " . mysqli_connect_error());
}
$email = mysqli_real_escape_string($conexion, $email);
$sql = "SELECT correo FROM usuarios WHERE correo = '".$email."'";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);
if (mysqli_num_rows($resultado) > 0){
    echo 'registered';
}
else echo 'unregistered';
