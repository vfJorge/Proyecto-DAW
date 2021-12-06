<?php
include("../funciones.php");
include("../variablesbd.php");
session_start();
if(array_key_exists('admin', $_SESSION)) {

    if($_SESSION["admin"] != 1) {
        header("Location: ../index.php");
    }
}
else{
    header("Location: ../index.php");
}


$sql = "SELECT * from reservaciones24hrs";
$resultado = ConsultarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);

if (count($resultado)!=0) {

    $tabla = "<div class='overflow-auto' style='border-radius: 5px'>\n";
    $tabla .= "\t<table class='table table-light table-striped table-hover align-middle text-center m-0 p-0' id='tablaReservaciones24hrs'>\n";
    $tabla .= "\t<tr>\n";

    $tabla .= "\t\t<th>Clave</th>\n";
    $tabla .= "\t\t<th>Correo</th>\n";
    $tabla .= "\t\t<th>Sucursal</th>\n";
    $tabla .= "\t\t<th>No. personas</th>\n";
    $tabla .= "\t\t<th>Fecha</th>\n";
    $tabla .= "\t\t<th>Hora</th>\n";

    $tabla .= "\t</tr>\n";

    for ($i = 0; $i < count($resultado); $i++) {
        $tabla .= "\t<tr id=''>\n";

        $clave = $resultado[$i]["clave"];
        $correo = $resultado[$i]["correo"];
        $sucursal = str_replace("Sucursal ","",$resultado[$i]["sucursal"]);
        $personas = $resultado[$i]["personas"];
        $fecha = $resultado[$i]["fecha"];
        $hora = $resultado[$i]["hora"];
        setlocale(LC_TIME, "es_MX.UTF-8", "Spanish");
        $timestamp = strtotime($fecha);
        $fechaFormateada = ucwords(utf8_encode(strftime("%A %d/%m/%Y", $timestamp)));
        $timestamp = strtotime($hora);
        $horaFormateada = strftime("%H:%M", $timestamp);

        $num = $i+1;

        $tabla .= "\t\t<td >$clave</td>\n";
        $tabla .= "\t\t<td >$correo</td>\n";
        $tabla .= "\t\t<td>$sucursal</td>\n";
        $tabla .= "\t\t<td>$personas</td>\n";
        $tabla .= "\t\t<td>$fechaFormateada</td>\n";
        $tabla .= "\t\t<td>$horaFormateada</td>\n";

        $tabla .= "\t</tr>\n";

    }

    $tabla .= "\n</table>\n";
    $tabla .= "</div>\n";
    echo $tabla;
}
else{
    $salida = "<div class='d-flex justify-content-center align-items-center flex-column p-3'>\n";

    $salida .= "<i class='bi-clock text-muted p-2' style='font-size: 50px'></i>";
    $salida .= "<p class='p-2 text-muted text-center secondaryFont'>No hay reservaciones en las próximas 24 horas</p>";
    $salida .= "</div>\n";
    echo $salida;
}