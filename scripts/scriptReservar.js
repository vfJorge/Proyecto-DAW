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
    console.log(fechaActual)

    document.getElementById("fecha").onfocus = function (){
        document.getElementById("fecha").setAttribute("min",fechaActual);
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            let sucursales = JSON.parse(this.responseText);

            for (let suc of sucursales){
                document.getElementById("sucursalSelector").innerHTML += "<option>"+suc["nombre"]+"</option>";
            }

        }
    }
    xhttp.open("POST", "sucursales.json");
    xhttp.send();

})




