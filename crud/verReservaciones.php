<?php
include("../funciones.php");
include("../variablesbd.php");

$sql = "SELECT * from reservaciones_noadmin";
$resultado = ConsultarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);

$busqueda = (isset($_POST['buscar']))?strtolower($_POST['buscar']):"";
$busqueda = filter_var($busqueda, FILTER_SANITIZE_STRING);


if (count($resultado)!=0) {


    $tabla = "<table class='table table-bordered text-center table-striped table-hover align-middle '>
        <thead>
          <tr>
            <th>Clave</th>
            <th>Correo</th>
            <th>Sucursal</th>
            <th>No. personas</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>";
    $match = false;
    for ($i = 0; $i < count($resultado); $i++) {
        $clave = $resultado[$i]['clave'];
        $correo = $resultado[$i]['correo'];
        $sucursal = $resultado[$i]['sucursal'];
        $personas = $resultado[$i]['personas'];
        $fecha = $resultado[$i]['fecha'];
        $hora = $resultado[$i]['hora'];

        setlocale(LC_TIME, "es_MX.UTF-8", "Spanish");
        $timestamp = strtotime($fecha);
        $fechaFormateada = ucwords(utf8_encode(strftime("%A %d/%m/%Y", $timestamp)));
        $timestamp = strtotime($hora);
        $horaFormateada = strftime("%H:%M", $timestamp);


        $correoParse = strtolower($correo);
        $sucursalParse = strtolower($sucursal);
        $fechaParse = strtolower($fechaFormateada);


        if(str_contains($clave,$busqueda) || str_contains($correoParse,$busqueda) || str_contains($sucursalParse,$busqueda) ||  str_contains($personas,$busqueda) || str_contains($fechaParse,$busqueda) || str_contains($horaFormateada,$busqueda)){
            $match = true;

            $tabla .= "  
                        <tr>
                        <td>".$clave."</td>
                        <td>".$correo."</td>
                        <td>".$sucursal."</td>
                        <td>".$personas."</td>
                        <td>".$fechaFormateada."</td>
                        <td>".$horaFormateada."</td>
                        <td class='text-center'>
                        <a href=\"edit.php?clave=".$clave."\" class='btn btn-primary'>
                            <i class='bi-pencil-square' style='font-size: 18px'></i>
                        </a>
                        <a href=\"delete_task.php?clave=".$clave."\" class='btn btn-danger'>
                            <i class='bi-trash' style='font-size: 18px'></i>
                        </a>
                        </td>
                    </tr>";
        }
    }
    if (!$match){
        $tabla = "<div class='d-flex justify-content-center align-items-center flex-column p-3'>\n";
        $tabla .= "<i class='bi-three-dots text-muted p-2' style='font-size: 50px'></i>";
        $tabla .= "<p class='p-2 text-muted text-center secondaryFont'>No hay resultados para su búsqueda</p>";
        $tabla .= "</div>";
    }

    $tabla .= "</tbody>";
    $tabla .=  "</table>";

    echo $tabla;
}
else{
    $salida = "<div class='d-flex justify-content-center align-items-center flex-column p-3'>\n";

    $salida .= "<i class='bi-three-dots text-muted p-2' style='font-size: 50px'></i>";
    $salida .= "<p class='p-2 text-muted text-center secondaryFont'>No hay reservaciones en la base de datos</p>";
    $salida .= "</div>\n";
    echo $salida;
}