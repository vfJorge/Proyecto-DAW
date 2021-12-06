<?php
include("db.php");
$title = '';
$description= '';

if(array_key_exists('admin', $_SESSION)) {

    if($_SESSION["admin"] != 1) {
        header("Location: ../index.php");
    }
    else{
        if  (isset($_GET['clave'])) {
            $clave = $_GET['clave'];
            $query = "SELECT * FROM reservaciones WHERE clave=$clave";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $sucursal = $row['sucursal'];
                $fecha = $row['fecha'];
                $hora = $row['hora'];
                $personas = $row['personas'];
            }
        }

        if (isset($_POST['update'])) {
            $clave = $_GET['clave'];
            $sucursal = $_POST['sucursal'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $personas = $_POST['personas'];

            $query = "UPDATE reservaciones set sucursal = '$sucursal', fecha = '$fecha', hora = '$hora', personas = '$personas' WHERE clave=$clave";
            mysqli_query($conn, $query);
            $_SESSION['message'] = 'Reservaci&oacuten '.$clave.'<br> Se actualiz&oacute correctamente';
            $_SESSION['message_type'] = 'warning';
            header('Location: crud.php');
        }
    }
}
else{
    header("Location: ../index.php");
}




?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body bg-light">
        <form action="edit.php?clave=<?php echo $_GET['clave']; ?>" method="POST" class="was-validated">
        
        <div class="mb-3">
          <label for="sucursalSelector" class="form-label">Elija la sucursal:</label>
          <select class="form-select" name="sucursal" id="sucursalSelector"></select>
          <p class="text-primary small">Asegurese de seleccionar de nuevo la sucursal</p>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="numero-personas" class="form-label">Mesa para cuántas personas:</label>
          <input type="text" class="form-control" id="numero-personas" name="personas" value="<?php echo $personas; ?>" placeholder="Numero de personas" pattern="[1-9]{1}" required>
          <div class="invalid-feedback">Debe ingresar un número entre 1 y 9</div>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="fecha" class="form-label">Seleccione fecha:</label>
          <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>" min="2021-01-29" max="2030-12-31" required>
          <div class="invalid-feedback">Debe seleccionar una fecha válida</div>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="time" class="form-label">Seleccione hora:</label>
          <input type="time" class="form-control"  id="time" value="<?php echo $hora; ?>" name="hora" required></div>

        <div class="d-flex container-fluid justify-content-center align-items-start">
        <button type="submit" name="update" class="btn mt-2 p-3 btn-success btn-block text-center">Actualizar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

