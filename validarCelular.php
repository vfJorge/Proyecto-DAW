<?php

include("funciones.php");
include("variablesbd.php");

$celular = $_REQUEST["celular"];

$sql = "SELECT celular FROM usuarios WHERE celular = '".$celular."'";

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
if (!$conexion) {
    die("Fallo: " . mysqli_connect_error());
}

$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);
if (mysqli_num_rows($resultado) > 0){
    echo 'registered';
}
else echo 'unregistered';
