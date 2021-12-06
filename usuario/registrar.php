<?php
include("../funciones.php");
include("../variablesbd.php");
session_start();
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
if (!$conexion) {
    die("Fallo: " . mysqli_connect_error());
}

$nombre = $_REQUEST["nombre"];
$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
$nombre = mysqli_real_escape_string($conexion,$nombre);

$celular = $_REQUEST["celular"];
$celular = mysqli_real_escape_string($conexion,$celular);

$email = $_REQUEST["email"];
$email = mysqli_real_escape_string($conexion,$email);

$password = $_REQUEST["password"];
$password = filter_var($password, FILTER_SANITIZE_STRING);
$password = mysqli_real_escape_string($conexion,$password);

$sql = "CALL registrarUsuario('".$email."','".$nombre."','".$celular."','".$password."')";

EjecutarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);

$_SESSION["email"] = $email;
$_SESSION["nombre"] = $nombre;

header("Location: ../index.php");