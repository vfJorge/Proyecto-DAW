
<?php session_start();

if(array_key_exists('nombre',$_SESSION) && array_key_exists('email',$_SESSION) ) {
    echo "
<script>
  window.addEventListener('DOMContentLoaded', function (){
      
      document.getElementById('bienvenida').innerText = 'Hola ".$_SESSION["nombre"]."';
      
  });

</script>
";
}
else{
    echo "
<script>
  window.addEventListener('DOMContentLoaded', function (){
      
      document.getElementById('divFormularioReservacion').classList.add('d-none');
          document.getElementById('izquierda').classList.add('col-lg-12');
    document.getElementById('derecha').classList.add('d-none');
    let bienvenida = document.getElementById('bienvenida');
    let botonVolver = document.createElement('a');
    botonVolver.setAttribute('href', 'index.php');
    botonVolver.classList.add('btn','btn-outline-warning')
    botonVolver.innerText='VOLVER A INICIO';
    
    bienvenida.after(botonVolver)
    
  });

</script>
";
}

if(array_key_exists('user_image', $_SESSION)) {

    if($_SESSION["user_image"] !== NULL) {
        echo "
        <script>
        window.addEventListener('DOMContentLoaded', function (){
            let userImages = document.getElementsByClassName('userImage');
            
            for (let img of userImages){
               
                img.setAttribute('src','uploaded_files/" . $_SESSION["user_image"] . "');
            }
        });
        </script>";
    }
};
?>

<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/reservarStyles.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="/proyecto/images/favicon.png">
    <script src="js/bootstrap.bundle.min.js"></script>
<script src="scripts/scriptReservar.js"></script>

<script src="scripts/cookieMethods.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script>
        const doc = new jsPDF();

        window.onload=function(){

            document.getElementById("descargarReservaciones").onclick=function(){
                html2canvas(document.getElementById("tablaReservaciones")).then(canvas => {
                    let img=canvas.toDataURL('image/png');
                    let enlace = document.createElement('a');
                    enlace.download = "reservaciones.png";
                    enlace.href = img;
                    enlace.click();
                });
            }

        }

    </script>

<title>Reservaciones</title>
</head>

<body>

<div class="row m-0 p-0 h-100">
    <div id="izquierda" class="p-0 m-0 text-white col-0 col-lg-6 d-flex flex-column">
        <div id="titulos" class="p-4">
            <h1>AGENDA TU RESERVACIÓN</h1>
            <h5>Llene los siguientes campos</h5>
            <a href="index.php" class="btn btn-dark float-end">VOLVER</a>

        </div>
        <div class="p-2 m-0 flex-grow-1 d-flex justify-content-center align-items-center flex-column">
            <img class="img-fluid userImage userImageOffCanvas rounded rounded-circle mt-4" src="images/login.png" alt="Imagen de usuario">
            <h3 class= "p-4 text-center" id="bienvenida">Para reservar necesitas registrarte, crea una cuenta en la página de inicio</h3>
        </div>

        <div class="p-2 m-0 flex-grow-1 d-flex justify-content-center align-items-center" id="divFormularioReservacion">
            <form action="reservacion/crear.php" method="POST" class="was-validated p-4 d-flex justify-content-center flex-column align-items-center" id="createForm" >

                <div class="mb-3">
                    <label for="sucursalSelector" class="form-label">Elija la sucursal:</label>
                    <select class="form-select" name="sucursal" id="sucursalSelector">

                    </select>
                </div>

                <a href="sucursales.html" class="btn btn-outline-warning">Conoce nuestras sucursales</a>

                <div class="mb-3 mt-3 form-group" >
                    <label for="numero-personas" class="form-label">Mesa para cuántas personas:</label>
                    <input type="text" class="form-control" id="numero-personas" name="numero-personas" placeholder="Numero de personas" pattern="[1-9]{1}" required>
                    <div class="invalid-feedback">Debe ingresar un número entre 1 y 9</div>
                </div>

                <div class="mb-3 mt-3 form-group" >
                    <label for="fecha" class="form-label">Seleccione fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha"  min="2021-01-29" max="2030-12-31" required>
                    <div class="invalid-feedback">Debe seleccionar una fecha válida</div>
                </div>

                <div class="mb-3 mt-3 form-group" >
                    <label for="time" class="form-label">Seleccione hora:</label>
                    <input type="time" class="form-control"  max="00:00" min="12:00"  id="time" name="hora" required>
                    <div class="invalid-feedback" id="horaInvalida">Debe seleccionar una hora válida. Horarios disponibles de 12 PM a 12 AM</div>
                </div>


                <div class="d-grid">
                    <button type="submit" class="mt-2 p-3 btn-primary btn-block text-center">CREAR RESERVACIÓN</button>
                </div>
            </form>
        </div>

    </div>

    <div id="derecha" class="col-12 col-lg-6 m-0 p-5">
        <div id="reservaciones" class="container-fluid text-white p-5 d-flex flex-column align-items-center">

            <h2 class="shadow">Reservaciones</h2>
            <p>Aquí verás tus reservaciones</p>

            <div id="obtenerReservaciones" class="d-flex justify-content-center align-items-center w-100">

            </div>
        </div>
        <div class="container-fluid p-4 d-flex flex-column align-items-center">
            <button class="btn btn-outline-warning d-none" id="descargarReservaciones">Descargar reservaciones</button>
        </div>

    </div>
</div>

<div class="container d-none">

</div>

</body>





</html>