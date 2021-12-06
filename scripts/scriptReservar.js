window.addEventListener("DOMContentLoaded", function (){
    let date = new Date();

    let day = date.getDate();
    if(String(day).length == "1"){
        day = "0" + String(day);
    }

    let month = date.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
    if(String(month).length == "1"){
        month = "0" + String(month);
    }

    let year = date.getFullYear();

    let fechaActual = year + "-" + month + "-" + day;

    document.getElementById("fecha").onfocus = function (){
        document.getElementById("fecha").setAttribute("min",fechaActual);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            let sucursales = JSON.parse(this.responseText);
            let sucCookie = readCookie("sucursal")
            if(sucCookie==null) sucCookie=1;
            for (let i in sucursales){
                if (sucCookie-1==i) document.getElementById("sucursalSelector").innerHTML += "<option selected>"+sucursales[i]["nombre"]+"</option>";
                else document.getElementById("sucursalSelector").innerHTML += "<option>"+sucursales[i]["nombre"]+"</option>";
            }
        }
    }
    xhttp.open("POST", "sucursales.json");
    xhttp.send();

    let xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("obtenerReservaciones").innerHTML=this.responseText;
            if (document.getElementById("tablaReservaciones")){
                document.getElementById('descargarReservaciones').classList.replace("d-none","d-block");
            }
        }
    };
    xhttp2.open("POST","reservacion/obtener.php");
    xhttp2.send();

    let form = document.getElementById("createForm");
    let horaInput = document.getElementById("time");
    let fechaInput = document.getElementById("fecha");
    let mensaje = document.getElementById("horaInvalida");

    form.onsubmit = function (evt){
        let fechaHoraSeleccionada = new Date(fechaInput.value + " " + horaInput.value);
        let fechaHoraActual = new Date();
        let fechaHoraPlus30Mins = new Date(fechaHoraActual.getTime()+1800000)


        if (fechaHoraSeleccionada.getTime() < fechaHoraPlus30Mins ){
            evt.preventDefault();
            mensaje.innerText="Seleccione una hora mínimo 30 minutos después de la actual";
            horaInput.setAttribute("min",String(fechaHoraPlus30Mins.getHours()).padStart(2, "0") + ":" + String(fechaHoraPlus30Mins.getMinutes()).padStart(2, "0"))
            fechaInput.onchange = function (){
                horaInput.setAttribute("min","12:00")
                mensaje.innerText="Debe seleccionar una hora válida. Horarios disponibles de 12 PM a 12 AM";

            }
        }

    }


})




