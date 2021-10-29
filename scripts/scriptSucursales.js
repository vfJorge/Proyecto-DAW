var suc = readCookie("sucursal");
if(suc==null) suc=1;
text = localStorage.getItem("sucFav");
var myObj;
if(text==null){
    myObj  = {"favoritos":[0,0,0,0,0,0,0,0,0,0]}
    myJSON = JSON.stringify(myObj);
    localStorage.setItem("sucFav",myJSON);
}
else{
    myObj = JSON.parse(text);
}

window.onload = function () {
    verSucursal(suc);
    loadSucursales();
    document.getElementById("hacerReservacion").onclick = function(){
        alert("Será manejado en una página php")
        //location.assign("reservacion.php?suc="+suc); FUNCION RESERVACION
    }
    document.getElementById("addFavoritos").onclick = function (){
        addFavoritos();
    }
}
function verSucursal(i){
    suc = i;
    createCookie("sucursal",suc);
    loadSucursal();
    if(myObj.favoritos[suc-1]===0){
        document.getElementById("addFavoritos").setAttribute("class","btn btn-warning");
        document.getElementById("addFavoritos").innerHTML = "Añadir a favoritos";
    }
    else{
        document.getElementById("addFavoritos").setAttribute("class","btn btn-danger");
        document.getElementById("addFavoritos").innerHTML = "Quitar de favoritos";
    }
}
function addFavoritos(){
    if(myObj.favoritos[suc-1]===0){
        myObj.favoritos[suc-1]=1;
        myJSON = JSON.stringify(myObj);
        localStorage.setItem("sucFav",myJSON);
        document.getElementById("addFavoritos").setAttribute("class","btn btn-danger");
        document.getElementById("addFavoritos").innerHTML = "Quitar de favoritos";
    }
    else if(myObj.favoritos[suc-1]===1){
        myObj.favoritos[suc-1]=0;
        myJSON = JSON.stringify(myObj);
        localStorage.setItem("sucFav",myJSON);
        document.getElementById("addFavoritos").setAttribute("class","btn btn-warning");
        document.getElementById("addFavoritos").innerHTML = "Añadir a favoritos";
    }
    loadSucursales();
}

function verFavoritos(){
    for(var i = 1; i <= myObj.favoritos.length; i++) {
        document.getElementById("suc"+i).innerHTML= data[i-1]["nombre"];
        if(myObj.favoritos[i-1]===1){
            document.getElementById("suc"+i).innerHTML = document.getElementById("suc"+i).innerHTML + "<i class=\"bi-bookmark-star-fill text-white px-2\" role=\"img\" aria-label=\"Telefono\"></i>";
        }
    }
}


function verVentana(url) {
    var ventana = window.open(url, "ventana", "width=500, height=400");
    ventana.focus();
}

function loadSucursales() {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            data = JSON.parse(this.responseText);
            verFavoritos();
        }
    }
    xhttp.open("GET", "sucursales.json");
    xhttp.send();
}

function loadSucursal() {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.responseText);
            let sucursalTitulo = document.getElementById("sucursalTitulo");
            let sucursalDesc = document.getElementById("sucursalDesc");
            let sucursalDir = document.getElementById("sucursalDir");
            let sucursalTel = document.getElementById("sucursalTel");

            sucursalTitulo.innerHTML = data[suc-1]["nombre"];
            sucursalDesc.innerHTML = data[suc-1]["descripcion"];
            sucursalDir.innerHTML = data[suc-1]["direccion"];
            sucursalTel.innerHTML = data[suc-1]["telefono"];

            document.getElementById("sucursalImg").setAttribute("style", "background-image: url(images/sucursales/suc" +suc+".jpg);");
            document.getElementById("mapaSucursal").innerHTML = '<iframe class="w-100 h-100" src="' +data[suc-1]["ubicacion"]+'" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        }
    }
    xhttp.open("GET", "sucursales.json");
    xhttp.send();
}