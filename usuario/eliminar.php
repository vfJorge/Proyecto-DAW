<?php
include("../variablesbd.php");
include("../funciones.php");

session_start();

$email = $_SESSION["email"];

$sql = "DELETE FROM `usuarios` WHERE `usuarios`.`correo` = '".$email."';";
EjecutarSQL ($servidor, $usuario, $contrasena, $basedatos, $sql);

if(array_key_exists('user_image', $_SESSION)) {
    if($_SESSION["user_image"] !== NULL) {
        unlink("../uploaded_files/".$_SESSION["user_image"]);
    }
}

session_destroy();
