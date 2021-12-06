<?php
include('db.php');
session_start();
if(array_key_exists('admin', $_SESSION)) {

    if($_SESSION["admin"] != 1) {
        header("Location: ../index.php");
    }
    else{
        if (isset($_POST['create'])) {
            $correo = $_POST['correo'];
            $sucursal = $_POST['sucursal'];
            $personas = $_POST['personas'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $sql = "CALL crearReservacion('".$correo."','".$sucursal."','".$personas."','".$fecha."','".$hora."')";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                //die("Query Failed.");
                $_SESSION['message'] = 'El correo no est&aacute registrado en la base de datos.<br>Solo puede agregar reservaciones de usuarios existentes';
                $_SESSION['message_type'] = 'danger';
            }
            else{
                $_SESSION['message'] = 'Se cre&oacute correctamente';
                $_SESSION['message_type'] = 'success';
            }
            header('Location: crud.php');

        }
    }
}
else{
    header("Location: ../index.php");
}

?>