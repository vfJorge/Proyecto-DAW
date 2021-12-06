window.addEventListener("DOMContentLoaded", () =>{

    let boton = document.getElementById("verReservaciones24hrs")

    boton.onclick = ()=>{
        let div = document.getElementById("divReservaciones24hrs");

        if (boton.classList.contains("desactivado")){
            boton.innerText = "OCULTAR";
            boton.classList.remove("desactivado");
            boton.classList.add("activado");
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    div.innerHTML = this.response;
                }
            };
            xhttp.open("POST", "verReservaciones24hrs.php", true);
            xhttp.send();
        }
        else if (boton.classList.contains("activado")){
            boton.innerText = "VER RESERVACIONES DE LAS PRÓXIMAS 24 HRS";
            boton.classList.remove("activado");
            boton.classList.add("desactivado");
            div.innerHTML = "";
        }

    }



})