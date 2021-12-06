<?php
include("../funciones.php");
include("../variablesbd.php");
session_start();

if (isset($_POST["sucursal"]) && isset($_POST["numero-personas"]) && isset($_POST["fecha"]) && isset($_POST["hora"])){
    $sucursal = $_POST["sucursal"];
    $personas = $_POST["numero-personas"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $email = $_SESSION["email"];

    $sql = "CALL crearReservacion('".$email."','".$sucursal."','".$personas."','".$fecha."','".$hora."')";

    EjecutarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);

    header("Location: ../reservacion.php");
}
