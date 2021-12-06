<?php

include("db.php");

if(array_key_exists('admin', $_SESSION)) {

  if($_SESSION["admin"] != 1) {
    header("Location: ../index.php");
  }
  else{
    if(isset($_GET['clave'])) {

      $clave = $_GET['clave'];
      $query = "DELETE FROM reservaciones WHERE clave = $clave";
      $result = mysqli_query($conn, $query);
      if(!$result) {
        die("Fallo: " . mysqli_connect_error());
      }

      $_SESSION['message'] = 'Reservación '.$clave.'<br> Eliminada con éxito';
      $_SESSION['message_type'] = 'danger';
      header('Location: crud.php');
    }
  }
}
else{
  header("Location: ../index.php");
}



?>
