<!DOCTYPE html>
<html lang="en">

  <head>
      <title>Modo administrador</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

      <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="../styles/crudStyles.css" type="text/css">
      <link rel="icon" type="image/x-icon" href="/proyecto/images/favicon.png">
      <script type="text/javascript" src="validacion.js"></script>
      <script type="text/javascript" src="../scripts/cookieMethods.js"></script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="verReservaciones24hrs.js"></script>
      <script type="text/javascript" src="botonBusqueda.js"></script>
  </head>

  <body class="bg-light">
        <header class="bg-dark">
            <div class="row p-4 m-0">
                <div class="col-sm-10 d-flex align-items-center align-items-md-start justify-content-center flex-column  text-center text-md-start">
                    <h3 class="mainFont text-white ">
                        Gestión de reservaciones Steak House
                    </h3>
                    <a href="../index.php" class="mt-2 p-2 btn buttonColor">VOLVER A INICIO</a>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-center  flex-wrap-reverse flex-lg-nowrap p-3">
                    <h6 class="text-white m-2 text-center"><?php echo $_SESSION['nombre']?></h6>
                    <img src="../images/login.png" alt="Imagen de usuario" class="userImage rounded rounded-circle m-2" >
                </div>
            </div>
        </header>
