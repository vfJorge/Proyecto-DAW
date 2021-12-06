<?php session_start();

if(array_key_exists('email',$_SESSION)) {
    echo "
<script>
  window.addEventListener('DOMContentLoaded', function (){
      
      document.getElementById('offCanvasTrigger').setAttribute('data-bs-target', '#logedInOffCanvas');
      document.getElementById('verUserImage').setAttribute('data-bs-target','#verFotoModal')
      
  });

</script>
";
    if (array_key_exists('admin',$_SESSION) && $_SESSION["admin"] == '1'){
        echo "
<script>

  window.addEventListener('DOMContentLoaded', function (){

let cerrarSesionBoton = document.getElementById('cerrarSesion');

let botonera = document.getElementById('botonesSesion')
let boton = document.createElement('button');
let texto = document.createTextNode('ADMINISTRAR');

boton.setAttribute('class', 'btn-primary my-2 p-2 btn-block text-center');
boton.onclick = function (){
    location.href = 'crud/crud.php';
}

boton.appendChild(texto);
botonera.insertBefore(boton, cerrarSesionBoton);

});

</script>
";
    }
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/sucursalesStyles.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="/proyecto/images/favicon.png">

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>

        window.addEventListener("DOMContentLoaded", function (){
            let formModal = document.getElementById("modal-form");
            let formLogin = document.getElementById("login-form");
            let cerrarSesion = document.getElementById("cerrarSesion");
            let borrarCuenta = document.getElementById("borrarCuenta");
            let cancelarCambiarFoto = document.getElementById("cancelarCambiarFoto")

            let nombre = document.getElementById("modal-form-nombre");
            let password = document.getElementById("modal-form-password");
            let confirm = document.getElementById("modal-form-password-confirm");
            let email = document.getElementById("modal-form-email");
            let celular = document.getElementById("modal-form-celular");

            const hasNumber = str => /\d/.test(str);

            //REGISTER CLIENT VALIDATION
            nombre.onkeyup = function (){
                if (nombre.value==="" || hasNumber(nombre.value) || nombre.value.length>60){
                    nombre.classList.remove("is-valid");
                    nombre.classList.add("is-invalid")

                }
                else {
                    nombre.classList.remove("is-invalid");
                    nombre.classList.add("is-valid");
                }
            }
            password.onkeyup = function (){

                if (confirm.value.length<8) {
                    confirm.classList.remove("is-valid");
                    confirm.classList.add("is-invalid");
                    document.getElementById("dontMatchAlert").innerHTML = "La contraseña debe coincidir y tener entre 8 y 50 caracteres<br>Intente de nuevo";
                }
                else if(password.value !== confirm.value) {
                    confirm.classList.remove("is-valid");
                    confirm.classList.add("is-invalid");
                    document.getElementById("dontMatchAlert").innerHTML = "La contraseña debe coincidir<br>Intente de nuevo";
                }
                else{
                    confirm.classList.remove("is-invalid");
                    confirm.classList.add("is-valid");
                }

                if (password.value==="" || password.value.length>50){
                    password.classList.remove("is-valid");
                    password.classList.add("is-invalid");

                }
                else{
                    if (password.value.length<8){
                        password.classList.remove("is-valid");
                        password.classList.add("is-invalid");

                    }
                    else{
                        password.classList.remove("is-invalid");
                        password.classList.add("is-valid");
                    }
                }
            }
            confirm.onkeyup = function (){
                if (confirm.value.length<8 || confirm.value==="" || confirm.value.length>50){
                    confirm.classList.remove("is-valid");
                    confirm.classList.add("is-invalid");
                    document.getElementById("dontMatchAlert").innerHTML = "La contraseña debe coincidir y tener entre 8 y 50 caracteres<br>Intente de nuevo";
                }
                else{
                    if (password.value.length<8){
                        confirm.classList.remove("is-valid");
                        confirm.classList.add("is-invalid");
                        document.getElementById("dontMatchAlert").innerHTML = "La contraseña debe coincidir y tener entre 8 y 50 caracteres<br>Intente de nuevo";
                    }
                    else if (password.value !== confirm.value) {
                        confirm.classList.remove("is-valid");
                        confirm.classList.add("is-invalid");
                        document.getElementById("dontMatchAlert").innerHTML = "Las contraseñas no coinciden<br>Intente de nuevo";

                    }
                    else {
                        confirm.classList.remove("is-invalid");
                        confirm.classList.add("is-valid");
                    }
                }
            }
            celular.onkeyup = function () {
                if (celular.value === "") {
                    celular.classList.remove("is-valid");
                    celular.classList.add("is-invalid");
                    document.getElementById("celular-registered").innerText = "Celular inválido";
                } else {
                    if (celular.value.length !== 10 || isNaN(celular.value)) {
                        celular.classList.remove("is-valid");
                        celular.classList.add("is-invalid")
                        document.getElementById("celular-registered").innerText = "Celular inválido";
                    }
                    else{
                        celular.classList.remove("is-invalid");
                        celular.classList.add("is-valid");
                    }
                }
            }
            email.onkeyup = function () {
                if (email.value === "" || email.value.length > 60) {
                    email.classList.remove("is-valid");
                    email.classList.add("is-invalid");
                    document.getElementById("email-registered").innerText = "Correo electrónico inválido";
                } else {
                    let re = /\S+@\S+\.\S+/;
                    if (!re.test(email.value)) {
                        email.classList.remove("is-valid");
                        email.classList.add("is-invalid");
                        document.getElementById("email-registered").innerText = "Correo electrónico inválido";
                    }
                    else{
                        email.classList.remove("is-invalid");
                        email.classList.add("is-valid");
                    }
                }
            }

            formModal.onsubmit = function (event) {

                event.preventDefault();

                if (email.classList.contains("is-valid")) {
                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            if (this.responseText === "registered") {
                                email.classList.remove("is-valid");
                                email.classList.add("is-invalid");
                                document.getElementById("email-registered").innerText = "Este correo ya está registrado";

                            } else {
                                email.classList.remove("is-invalid");
                                email.classList.add("is-valid");
                            }
                        }
                    };
                    xmlhttp.open("POST", "validarEmail.php", false);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("email=" + email.value);
                }

                if (celular.classList.contains("is-valid")) {
                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            if (this.responseText === "registered") {
                                celular.classList.remove("is-valid");
                                celular.classList.add("is-invalid");
                                document.getElementById("celular-registered").innerText = "Este celular ya está registrado";
                            } else {
                                celular.classList.remove("is-invalid");
                                celular.classList.add("is-valid");
                            }
                        }
                    };
                    xmlhttp.open("POST", "validarCelular.php", false);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("celular=" + celular.value);

                }


                if (nombre.classList.contains("is-valid") && celular.classList.contains("is-valid") &&
                    email.classList.contains("is-valid") && password.classList.contains("is-valid") &&
                    confirm.classList.contains("is-valid")) {
                    event.currentTarget.submit();
                    alert("Cuenta creada correctamente")
                }
            }

            formLogin.onsubmit = function (event){

                event.preventDefault();

                let email = document.getElementById("login-email");
                let pass = document.getElementById("login-pass");

                if (email.value === "" || email.value.length>60){
                    email.classList.add("is-invalid");
                    document.getElementById("login-email-error").innerText="Correo electrónico inválido";

                }
                else{
                    let re = /\S+@\S+\.\S+/;
                    if (re.test(email.value)){
                        let xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                if (this.responseText !== "registered"){
                                    email.classList.add("is-invalid");
                                    document.getElementById("login-email-error").innerText="Este correo no está registrado.";
                                }
                                else{
                                    email.classList.remove("is-invalid");
                                    email.classList.add("is-valid");
                                }
                            }
                        };
                        xmlhttp.open("POST","validarEmail.php", false);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("email="+email.value);

                    }
                    else{
                        email.classList.add("is-invalid");

                        document.getElementById("login-email-error").innerText="Correo electrónico inválido";
                    }
                }

                if (pass.value=== "" || pass.value.length>50){
                    pass.classList.add("is-invalid");
                    document.getElementById("login-pass-error").innerText="Ingrese una contraseña válida";
                }
                else{
                    pass.classList.remove("is-invalid");
                }

                if (email.classList.contains("is-valid") && !pass.classList.contains("is-invalid")) {
                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            if (this.responseText !== "match"){
                                pass.classList.add("is-invalid");
                                document.getElementById("login-pass-error").innerText="Parte de su información no es correcta.";
                            }
                            else{
                                pass.classList.remove("is-invalid");
                                pass.classList.add("is-valid");

                                location.reload();
                            }
                        }
                    };
                    xmlhttp.open("POST","usuario/login.php", false);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("login-email="+email.value+"&login-pass="+pass.value);
                }

            }

            cerrarSesion.onclick = function (){
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload();

                    }
                };
                xmlhttp.open("POST","destruirSesion.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send();
            }

            borrarCuenta.onclick = function (){
                if (window.confirm("¿Desea borrar su cuenta? Esta acción no puede deshacerse")){
                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            location.reload();
                            alert("Cuenta eliminada");
                        }
                    };
                    xmlhttp.open("POST","usuario/eliminar.php");
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send();
                }

            }

            cancelarCambiarFoto.onclick = function (){
                location.reload();
            }

            function manejarSubidaImagen(evt) {
                let file = evt.target.files[0]; // FileList object

                let reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        if (validarImagen(file)){
                            // Render thumbnail.
                            let previsualizacion = document.getElementById("previsualizarImg");
                            previsualizacion.setAttribute('src', e.target.result);
                            previsualizacion.setAttribute('alt', theFile.name);
                            previsualizacion.setAttribute('name', theFile.name);

                            verBotonAceptar();
                        }
                    };
                })(file);

                // Read in the image file as a data URL.
                reader.readAsDataURL(file);

            }

            function manejarDragDrop(evt) {
                evt.stopPropagation();
                evt.preventDefault();

                let file = evt.dataTransfer.files[0]; // FileList object.

                let reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        if (validarImagen(file)){
                            // Render thumbnail.
                            let previsualizacion = document.getElementById("previsualizarImg");
                            previsualizacion.setAttribute('src', e.target.result);
                            previsualizacion.setAttribute('alt', theFile.name);
                            previsualizacion.setAttribute('name', theFile.name);

                            let list = new DataTransfer();
                            list.items.add(file);

                            document.getElementById("fotoSubida").files = list.files;

                            verBotonAceptar();
                        }
                    };
                })(file);

                // Read in the image file as a data URL.
                reader.readAsDataURL(file);

            }

            function handleDragOver(evt) {
                evt.stopPropagation();
                evt.preventDefault();
                evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
            }

            function validarImagen(file){
                if (file.type === "image/png" || file.type === "image/jpg" || file.type === "image/gif" || file.type === "image/jpeg" ) {
                    if (file.size < 4000000) return true;
                    else {
                        alert("El tamaño del archivo no puede exceder 4 MB. Intente con otra imagen");
                        return false;
                    }
                }
                else {
                    alert("Tipo de archivo no permitido. Suba una imagen en formato JPG, PNG o GIF")
                    return false;
                }
            }

            function verBotonAceptar(){

                if (!document.getElementById("cambiarFotoBotonAceptar")){
                    let footer = document.getElementById('cambiarFotoModalFooter');

                    let boton = document.createElement('button');
                    let texto = document.createTextNode('Aceptar y cambiar');

                    boton.setAttribute('class', 'btn btn-primary');
                    boton.setAttribute('id', 'cambiarFotoBotonAceptar');
                    boton.onclick = function (){

                        let file_obj = document.getElementById("fotoSubida").files[0];

                        let form_data = new FormData();
                        form_data.append('fotoSubida', file_obj);
                        let xhttp = new XMLHttpRequest();

                        xhttp.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                location.reload();
                            }
                        };
                        xhttp.open("POST", "usuario/subirFoto.php", true);
                        xhttp.send(form_data);
                    }

                    boton.appendChild(texto);
                    footer.appendChild(boton);
                }
            }

            //DRAG & DROP FOTO USUARIO
            let dropZone = document.getElementById('drop_zone');
            dropZone.addEventListener('dragover', handleDragOver, false);
            dropZone.addEventListener('drop', manejarDragDrop, false);

            document.getElementById('fotoSubida').addEventListener('change', manejarSubidaImagen, false);

           function matchOjoPass(divId, ojoId, passInputId){

               let div = document.getElementById(divId);
               let ojo = document.getElementById(ojoId);
               let pass = document.getElementById(passInputId)

                div.onclick = function (){
                    if (pass.type === "password") {
                        pass.type = "text";
                        ojo.classList.remove("bi-eye");
                        ojo.classList.add("bi-eye-slash")
                    }
                    else if (pass.type === "text") {
                        pass.type = "password";
                        ojo.classList.remove("bi-eye-slash");
                        ojo.classList.add("bi-eye")
                    }
                }


           }

            matchOjoPass("verPasswordLogin", "ojoVerPasswordLogin", "login-pass");
            matchOjoPass("verPasswordRegister", "ojoVerPasswordRegister", "modal-form-password");
            matchOjoPass("verPasswordRegisterConfirm", "ojoVerPasswordRegisterConfirm", "modal-form-password-confirm");
        })


    </script>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">

<header>
    <nav class="navbar navbar-expand-sm text-white navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item me-1">
                        <a class="nav-link rounded" href="#section1">INICIO</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link rounded" href="#section2">CONOCER</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link rounded" href="#section3">MENÚ</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link rounded" href="sucursales.html">SUCURSALES</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link rounded text-white" id="reservarNav" href="reservacion.php">RESERVAR</a>
                    </li>
                </ul>
            </div>

            <a class="nav-item navbar-brand" id="offCanvasTrigger" data-bs-toggle="offcanvas" data-bs-target="#userInfoOffCanvas" >
                <img src="images/login.png" alt="Imagen de usuario" class=" userImage rounded rounded-circle" >
            </a>

        </div>
    </nav>
</header>

<div id="section1" class="bg-image" >
    <div class="darkenMask">
        <div class=" container-fluid m-0 p-5 row">
        <div class="col-sm-6 align-items-center flex-column justify-content-center text-white text-center d-none d-md-flex">
            <h1>STEAK HOUSE</h1>
            <h2>PREMIUM BUFFET RESTAURANT</h2>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-start flex-column justify-content-center">
            <img class="mx-auto d-block img-fluid w-50" src="images/logo.png" alt="Logo Steak House">
        </div>
        </div>
    </div>

</div>

<div id="section2" class="container-fluid row m-0 p-0 align-items-center justify-content-center" >

    <div class="col-md-4 p-4 " >
        <div class="card text-white p-0 bg-transparent">
            <video autoplay muted loop class="card-img-top p-0 m0">
                <source src="videos/about.mp4" type="video/mp4">
                Tu navegador no soporta videos HTML5
            </video>
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column">
                <h2 class="card-title">Acerca de</h2>
                <p class="card-text">El mejor restaurante de cortes de carne desde 2010</p>
                <a href="#section2" class="btn" data-bs-toggle="modal" data-bs-target="#historiaModal"> CONÓCENOS</a>
            </div>
        </div>

    </div>

    <div class="col-md-4 p-4">
        <div class="card text-white p-0 m-0 bg-transparent">
            <video autoplay muted loop class="card-img-top">
                <source src="videos/chef.mp4" type="video/mp4">
                Tu navegador no soporta videos HTML5
            </video>
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column flex-grow-1">
                <h2 class="card-title">A disfrutar</h2>
                <p class="card-text">Siempre hay una mesa disponible para ti</p>
                <a href="reservacion.php" class="btn">RESERVAR</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 p-4">
        <div class="card text-white p-0 bg-transparent">
            <video autoplay muted loop class="card-img-top">
                <source src="videos/gallery.mp4" type="video/mp4">
                Tu navegador no soporta videos HTML5
            </video>
            <div class="card-img-overlay  d-flex align-items-center justify-content-center flex-column">
                <h2 class="card-title">Sucursales</h2>
                <p class="card-text">Contamos con sucursales en todo México</p>
                <a href="sucursales.html" class="btn">VER</a>
            </div>
        </div>
    </div>
    </div>

<div id="section3" class="m-0 p-0 d-flex justify-content-center align-items-center">

    <div id="menuCarrusel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">

        <div class="carousel-indicators m-0 mb-3 mb-sm-3 mb-xl-4">
            <button type="button" data-bs-target="#menuCarrusel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#menuCarrusel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#menuCarrusel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#menuCarrusel" data-bs-slide-to="3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container-fluid pt-5 pb-2 d-flex justify-content-center align-items-center text-white">
                        <div class="container-fluid m-0 p-0  w-75 h-75">
                        <div class="row m-0">
                            <div class="col-md-12 m-0 py-lg-2 px-lg-5 py-sm-1 px-sm-3">
                                <h5 class="text-muted">MENÚ</h5>
                                <h1 class="m-0 p-0 ">DESAYUNO</h1>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-8 m-0  p-5">
                                <img class="img-fluid m-0 " src="images/carrusel/desayuno.jpg" alt="Desayunos">
                            </div>
                            <ul class="col-md-4 list-group m-0 ps-0 pb-5 px-md-2 py-md-5">
                                    <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                        <h6>Huevos a la mexicana</h6>
                                        <h6><span class="badge badge-info">$79.00</span></h6>
                                    </li>
                                    <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                        <h6>Chorizo argentino</h6>
                                        <h6><span class="badge badge-info">$119.00</span></h6>
                                    </li>
                                    <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                        <h6>Chistorra</h6>
                                        <h6><span class="badge badge-info">$119.00</span></h6>
                                    </li>
                                    <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                        <h6>Pan tostado con mantequilla</h6>
                                        <h6><span class="badge badge-info">$49.00</span></h6>
                                    </li>
                                    <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                        <h6>Molletes con chorizo</h6>
                                        <h6><span class="badge badge-info">$69.00</span></h6>
                                    </li>
                                </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid pt-5 pb-2 d-flex justify-content-center align-items-center text-white">
                    <div class="container-fluid m-0 p-0  w-75 h-75">
                        <div class="row m-0">
                            <div class="col-md-12 m-0 py-lg-2 px-lg-5 py-sm-1 px-sm-3">
                                <h5 class="text-muted">MENÚ</h5>
                                <h1 class="m-0 p-0 ">COMIDA</h1>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-8 m-0  p-5">
                                <img class="img-fluid m-0 " src="images/carrusel/comida.jpg" alt="Comida">
                            </div>
                            <ul class="col-md-4 list-group m-0 ps-0 pb-5 px-md-2 py-md-5">
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Chuletón</h6>
                                    <h6><span class="badge badge-info">$99.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Hígado de ternera</h6>
                                    <h6><span class="badge badge-info">$109.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Corte Baby Sirloin</h6>
                                    <h6><span class="badge badge-info">$149.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Picanha</h6>
                                    <h6><span class="badge badge-info">$179.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Corte estilo americano</h6>
                                    <h6><span class="badge badge-info">$99.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Chuleta de cerdo</h6>
                                    <h6><span class="badge badge-info">$99.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Pollo rostizado</h6>
                                    <h6><span class="badge badge-info">$89.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Parrillada House Steak</h6>
                                    <h6><span class="badge badge-info">$339.00</span></h6>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid pt-5 pb-2 d-flex justify-content-center align-items-center text-white">
                    <div class="container-fluid m-0 p-0  w-75 h-75">
                        <div class="row m-0">
                            <div class="col-md-12 m-0 py-lg-2 px-lg-5 py-sm-1 px-sm-3">
                                <h5 class="text-muted">MENÚ</h5>
                                <h1 class="m-0 p-0 ">CENA</h1>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-8 m-0  p-5">
                                <img class="img-fluid m-0 " src="images/carrusel/cena.jpg" alt="Cena">
                            </div>
                            <ul class="col-md-4 list-group m-0 ps-0 pb-5 px-md-2 py-md-5">
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Chistorra con queso</h6>
                                    <h6><span class="badge badge-info">$80.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Rib eye</h6>
                                    <h6><span class="badge badge-info">$249.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Sirloin</h6>
                                    <h6><span class="badge badge-info">$169.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Filete mignon</h6>
                                    <h6><span class="badge badge-info">$199.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Asado de tira</h6>
                                    <h6><span class="badge badge-info">$199.00</span></h6>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid pt-5 pb-2 d-flex justify-content-center align-items-center text-white">
                    <div class="container-fluid m-0 p-0  w-75 h-75">
                        <div class="row m-0">
                            <div class="col-md-12 m-0 py-lg-2 px-lg-5 py-sm-1 px-sm-3">
                                <h5 class="text-muted">MENÚ</h5>
                                <h1 class="m-0 p-0 ">POSTRES</h1>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-8 m-0 p-5">
                                <img class="img-fluid m-0  " src="images/carrusel/postres.jpg" alt="Postres">
                            </div>
                            <ul class="col-md-4 list-group m-0 ps-0 pb-5 px-md-2 py-md-5">
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Pay de frambuesa</h6>
                                    <h6><span class="badge badge-info">$89.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Brownie de chocolate</h6>
                                    <h6><span class="badge badge-info">$109.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Muffin relleno</h6>
                                    <h6><span class="badge badge-info">$69.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Helado</h6>
                                    <h6><span class="badge badge-info">$39.00</span></h6>
                                </li>
                                <li class="list-group-item text-white bg-black d-flex justify-content-between align-items-start">
                                    <h6>Pastel de cumpleaños</h6>
                                    <h6><span class="badge badge-info">$259.00</span></h6>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#menuCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

</div>

<footer class="h-25 p-5 d-flex justify-content-center align-items-center flex-column text-center">
    <div class="d-flex justify-content-center align-items-center h-100 mb-3">
        <i class="bi-facebook text-white  px-2" role="img" aria-label="Facebook"></i>
        <i class="bi-instagram text-white  px-2" role="img" aria-label="Instagram"></i>
        <i class="bi-twitter text-white px-2" role="img" aria-label="Twitter"></i>
        <i class="bi-whatsapp text-white px-2" role="img" aria-label="Whatsapp"></i>
        <i class="bi-telephone text-white px-2" role="img" aria-label="Telefono"></i>
    </div>

    <p class="text-white-50 m-0 px-4">House Steak. La casa de la carne</p>
    <p class="text-white-50 m-0 px-4">Copyright &copy; 2010-2021. Todos los derechos reservados</p>

</footer>

</body>

<div class="modal fade" id="historiaModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content text-white">

            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title p-4">STEAK HOUSE</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-4">

                <h2>Historia</h2>
                <img src="images/historia.jpg" alt="Creador" class="img-fluid p-3 pt-0 d-none d-lg-block float-end w-25">
                <p>Somos una empresa fundada el 28 de julio de 2010, con alto conocimiento en la producción y venta de cortes finos de carne, la experiencia adquirida a través de los años, nos da el conocimiento para valorar la importancia del cliente, quien es el motivo de nuestros esfuerzos, y así llegar a ustedes con la seguridad de poder ofrecerles un desayuno, comida o cena de excelente calidad con responsabilidad y cumplimiento. El hecho de contar con ustedes como nuestros clientes es motivo de satisfacción.</p>
                <h4>Misión</h4>
                <p>En Steak House tenemos como misión darle la excelencia a nuestros productos de carne con alta calidad, nutritivos, sanos y frescos, en función de satisfacer las necesidades del consumo, proporcionando en forma permanente bienestar y calidad de vida. Entregamos a nuestros consumidores los productos que ellos prefieren y eligen por nuestra calidad y presentación.</p>
                <h4>Visión</h4>
                <p>Nuestra visión es consolidarnos como la mejor empresa a nivel nacional, en cuanto a la producción y venta de cortes finos de carne, apoyándonos en instalaciones con la más alta tecnología para el manejo de nuestros productos. Contamos con personal altamente calificado, manteniendo nuestro riguroso y estricto control de calidad.</p>

                <div class="d-flex justify-content-end w-100">
                    <div class="d-flex flex-column w-25">
                        <img src="images/firma.png" alt="Firma del creador" class="p-3" style="filter: invert(80%)">
                        <p class="blockquote-footer p-3">Raúl Macizo - Fundador y CEO de Steak House</p>
                    </div>

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer border border-0">
                <button type="button" class="btn text-muted " data-bs-dismiss="modal">Entendido</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade registerModal" id="registerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-white">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ingresa los datos para crear tu cuenta</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body ">
                <form id="modal-form" method="post" action="usuario/registrar.php" novalidate>  <!-- FORMULARIO -->
                    <div class="mb-3 mt-3 form-group" >
                        <label for="user-name" class="form-label">Nombre y apellido:</label>
                        <input type="text" class="form-control" id="modal-form-nombre" placeholder="Nombre y apellido" name="nombre" required>
                        <div class="invalid-feedback">Ingrese un nombre y un apellido</div>
                    </div>

                    <div class="mb-3 mt-3 form-group" >
                        <label for="celular" class="form-label">Celular:</label>
                        <input type="tel" class="form-control" id="modal-form-celular" name="celular" placeholder="0123456789" pattern="[0-9]{10}" required>
                        <div class="invalid-feedback" id="celular-registered">Número de teléfono inválido</div>
                    </div>

                    <div class="mb-3 mt-3 form-group" >
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="modal-form-email" placeholder="correo@electronico" name="email" required>
                        <div class="invalid-feedback" id="email-registered">Correo electrónico inválido</div>
                    </div>
                    
                    <label for="password-login" class="form-label">Ingresar contraseña</label>
                    <div class="mb-3 form-group input-group">
                        <input type="password" class="form-control" id="modal-form-password" placeholder="********" name="password" pattern="[A-Za-z0-9]{8,}"  required>
                        <div class="input-group-text divVerPassword" id="verPasswordRegister" >
                            <i class="bi-eye" id="ojoVerPasswordRegister"></i>
                        </div>
                        <div class="invalid-feedback">La contraseña es muy corta o muy larga<br>Ingrese una contraseña de entre 8 y 50 caracteres</div>
                    </div>

                    <label for="password-login" class="form-label">Confirmar contraseña</label>
                    <div class="mb-3 form-group input-group">
                        <input type="password" class="form-control" id="modal-form-password-confirm" placeholder="********" name="password-confirm" pattern="[A-Za-z0-9]{8,}"  required>
                        <div class="input-group-text divVerPassword" id="verPasswordRegisterConfirm" >
                            <i class="bi-eye" id="ojoVerPasswordRegisterConfirm"></i>
                        </div>
                        <div class="invalid-feedback" id="dontMatchAlert">Las contraseñas no coinciden<br>Intente de nuevo</div>
                        <div id="dont-match"></div>
                    </div>


                    <div class="d-grid">
                        <button type="submit" class="mt-2 p-3 btn-primary btn-block text-center" id="registrarse" >REGISTRARSE</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer border border-0">
                <button type="button" class="btn text-muted " data-bs-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade p-3" id="cambiarFotoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cambiar foto de usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body d-flex flex-column justify-content-between align-items-center p-0">
                <img class="img-fluid userImage userImageOffCanvas rounded rounded-circle m-5" src="images/login.png" alt="Imagen de usuario" id="previsualizarImg" style="height: 200px; width: 200px; object-fit: cover">

                    <form class="d-flex flex-column align-items-center justify-content-center w-75 p-5 mx-5" id="drop_zone">
                        <p>Arrastre su imagen aquí</p>
                        <p>o</p>
                                <label for="fotoSubida" type="button" class="nice-button btn p-2">Seleccionar imagen</label>
                                <input type="file" name="fotoSubida" id= "fotoSubida" class="upload-btn form-control-file">
                    </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer border border-0" id="cambiarFotoModalFooter">
                <button type="button" class="btn text-muted" data-bs-dismiss="modal" id="cancelarCambiarFoto">Cancelar</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade p-3 bg-black bg-opacity-75" id="verFotoModal">
    <div class="modal-dialog modal-dialog-centered d-flex align-items-center justify-content-center">
        <img class="img-fluid userImage userImageOffCanvas rounded rounded-circle m-5" src="images/login.png" alt="Imagen de usuario" style="height: 400px; width: 400px; object-fit: cover">
    </div>
</div>

<div class="offcanvas offcanvas-end text-white p-5 justify-content-center align-items-center" id="userInfoOffCanvas">
    <div class="offcanvas-header">
        <div class="d-flex flex-fill justify-content-between align-items-center pe-2 flex-column">
            <img class="img-fluid userImage userImageOffCanvas rounded rounded-circle" src="images/login.png" alt="Imagen de usuario">
            <h1 class="offcanvas-title">Bienvenido</h1>
        </div>

    </div>

    <div class="offcanvas-body py-0 text-left">
        <form method="post" id="login-form">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="login-email" placeholder="Correo" name="login-email">
                <div class="invalid-feedback" id="login-email-error"></div>
            </div>
            <label for="pwd" class="form-label">Contraseña:</label>
            <div class="mb-3 input-group">
                <input type="password" class="form-control " id="login-pass" placeholder="Contraseña" name="login-pass" >
              
                    <div class="input-group-text divVerPassword" id="verPasswordLogin" >
                        <i class="bi-eye" id="ojoVerPasswordLogin"></i>
                    </div>
            
                <div class="invalid-feedback" id="login-pass-error"></div>
            </div>


            <div class="d-grid">
                <button type="submit" class="my-2 p-2 btn-primary btn-block text-center">INICIAR SESIÓN</button>
            </div>
        </form>
        <div class="d-flex justify-content-center align-items-center text-center">
            <p class="text-muted my-3 mx-2">¿No tienes una cuenta?</p>
            <a class="my-3 mx-2 text-decoration-underline" data-bs-toggle="modal" data-bs-target="#registerModal">Crea una</a>
        </div>
    </div>
    <button type="button" class="btn-close btn-close-white mb-2" data-bs-dismiss="offcanvas"></button>
</div>

<div class="offcanvas offcanvas-end text-white p-3 justify-content-center align-items-center" id="logedInOffCanvas">
    <div class="offcanvas-header">
        <div class="d-flex flex-fill justify-content-between align-items-center pe-2 flex-column">
            <img class="img-fluid userImage userImageOffCanvas rounded rounded-circle" id ="verUserImage" src="images/login.png" alt="Imagen de usuario" data-bs-toggle="modal">
            <h1 class="offcanvas-title">Bienvenido </h1>
            <h4><?php echo $_SESSION["nombre"]?></h4>
            <p class="text-muted"><?php echo $_SESSION["email"]?></p>
        </div>


    </div>

    <div class="offcanvas-body p-0 text-center">
        <div class="d-flex flex-fill justify-content-between flex-column" id="botonesSesion">
            <button type= "button" class="my-2 p-2 btn-primary btn-block text-center" data-bs-toggle="modal" data-bs-target="#cambiarFotoModal" id="cambiarFotoBoton">CAMBIAR IMAGEN</button>
            <button type= "button" class="my-2 mt-4 p-2 btn-primary btn-block text-center" id="cerrarSesion">CERRAR SESIÓN</button>
        </div>

    </div>
    <p class="text-danger my-4 mx-2 border border-danger p-2" id="borrarCuenta">Eliminar cuenta</p>
    <button type="button" class="btn-close btn-close-white mb-4" data-bs-dismiss="offcanvas"></button>
</div>
</html>