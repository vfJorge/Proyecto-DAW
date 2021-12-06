<?php

include("../variablesbd.php");
include("../funciones.php");


$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
if (!$conexion) {
    die("Fallo: " . mysqli_connect_error());
}


//Sanitizamos
$password = filter_var($_REQUEST["login-pass"], FILTER_SANITIZE_STRING);
$email = filter_var($_REQUEST["login-email"], FILTER_SANITIZE_EMAIL);
$password = mysqli_real_escape_string($conexion,$password);
$email = mysqli_real_escape_string($conexion,$email);
//Verificamos si es un usuario registrado en el restaurante

$found = "@found";

$sql = "CALL login('".$email."','".$password."', $found)";

$match = obtenerParametroProcedure($servidor, $usuario, $contrasena, $basedatos, $sql, $found);

//$match = 0 si no coinciden, 1 si coinciden;

if ($match){
    session_start();
    $sql = "SELECT nombre, admin, foto_perfil FROM usuarios WHERE correo = \"$email\";";
    $resultado = ConsultarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);
    $nombre = $resultado[0]["nombre"];
    $admin = $resultado[0]["admin"];
    $foto_perfil = $resultado[0]["foto_perfil"];

    $_SESSION["email"] = $email;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["admin"] = $admin;
    $_SESSION["user_image"] = $foto_perfil;
    echo "match";
}
else{
    echo "dont-match";

}


