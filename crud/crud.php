<?php include("db.php"); ?>
<?php include('includes/header.php'); ?>
<?php

if(array_key_exists('user_image', $_SESSION)) {

    if($_SESSION["user_image"] !== NULL) {
        echo "
        <script>
        window.addEventListener('DOMContentLoaded', function (){
            let userImages = document.getElementsByClassName('userImage');
            
            for (let img of userImages){
               
                img.setAttribute('src','../uploaded_files/" . $_SESSION["user_image"] . "');
            }
        });
        </script>";
    }
};

if(array_key_exists('admin', $_SESSION)) {

    if($_SESSION["admin"] != 1) {
        header("Location: ../index.php");
    }
}
else{
    header("Location: ../index.php");
}


?>

<main class="container-fluid p-4 bg-light">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible">
        <?= $_SESSION['message']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <?php unset($_SESSION['message']); } ?>




      <form action="create.php" method="POST" name="create" id="createForm" class="was-validated p-4">
        <div class="mb-3 form-group" >
          <label for="email" class="form-label">Correo:</label>
          <input type="email" class="form-control" id="modal-form-email" placeholder="correo@electronico" name="correo" required>
          <div class="invalid-feedback" id="email-registered">Correo electrónico inválido</div>
        </div>

        <div class="mb-3">
          <label for="sucursalSelector" class="form-label">Elija la sucursal:</label>
          <select class="form-select" name="sucursal" id="sucursalSelector">
          </select>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="numero-personas" class="form-label">Mesa para cuántas personas:</label>
          <input type="text" class="form-control" id="numero-personas" name="personas" placeholder="Numero de personas" pattern="[1-9]{1}" required>
          <div class="invalid-feedback">Debe ingresar un número entre 1 y 9</div>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="fecha" class="form-label">Seleccione fecha:</label>
          <input type="date" class="form-control" id="fecha" name="fecha"  min="2021-01-29" max="2030-12-31" required>
          <div class="invalid-feedback">Debe seleccionar una fecha válida</div>
        </div>

        <div class="mb-3 mt-3 form-group" >
          <label for="time" class="form-label">Seleccione hora:</label>
          <input type="time" class="form-control"  id="time" name="hora" required>
        </div>

        <div class="d-flex container-fluid justify-content-center align-items-start">
        <button type="submit" name="create" class="mt-2 p-3 btn btn-success mainFont" id="agregarBtn">AGREGAR</button>
        </div>
      </form>



    </div>
      <div class="col-md-8">

          <div class="input-group p-3 ">
              <i class="input-group-text bi-search"></i>
              <input type="text" name="buscar" id ="buscar"class="form-control" placeholder="Buscar">
          </div>

          <div class=" overflow-auto table-responsive p-3" id="tbodyCrud">
          </div>

          <div class="d-flex justify-content-center align-items-center flex-column">
              <button id="verReservaciones24hrs" class="btn btn-primary desactivado mainFont">VER RESERVACIONES DE LAS PRÓXIMAS 24 HRS</button>
              <div id="divReservaciones24hrs" class="m-3 w-100"></div>
          </div>

      </div>

  </div>
</main>
</body>
</html>


