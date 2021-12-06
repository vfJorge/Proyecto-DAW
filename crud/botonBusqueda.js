window.addEventListener("DOMContentLoaded", () =>{

    let inputBuscar = document.getElementById("buscar");

    function buscar(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("tbodyCrud").innerHTML = this.response;
            }
        };
        xhttp.open("POST", "verReservaciones.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("buscar=" + inputBuscar.value);

    }

    buscar();

    inputBuscar.onkeyup = buscar;

})
