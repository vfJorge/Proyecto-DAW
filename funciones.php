<?php

function EjecutarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {
    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
    if (!$conexion) {
        die("Fallo: " . mysqli_connect_error());
    }

    mysqli_query($conexion, $sentenciaSQL);
    mysqli_close($conexion);
}

function ConsultarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL){
    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
    if (!$conexion) {
        die("Fallo: " . mysqli_connect_error());
    }

    $resultados = mysqli_query($conexion, $sentenciaSQL);

    $registros = array();
    while ($row = mysqli_fetch_assoc($resultados)) {
        $registros[] = $row;
    }

    mysqli_close($conexion);

    return $registros;
}

function obtenerParametroProcedure ($servidor, $usuario, $contrasena, $basedatos, $llamada, $parametro){
    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
    if (!$conexion) {
        die("Fallo: " . mysqli_connect_error());
    }

    mysqli_query($conexion, $llamada);

    $select = mysqli_query($conexion, "SELECT $parametro");
    $result = mysqli_fetch_assoc($select);
    return $result["$parametro"];
}


?>