
const botones = document.querySelectorAll(".bEliminar");

botones.forEach(boton => {

    boton.addEventListener("click", function() {
        const matricula = this.dataset.matricula;
        alertify.confirm('¿Eliminar?', 'El usuario seleccionado será dado de baja del sistema. Matricula:'+matricula,
         function(){ 
            httpRequest("http://localhost/mvc/admins/eliminarAdmin/" + matricula, function() {
                //console.log(this.responseText);
                alertify.success('Se ha eliminado correctamente.'); 
                location.href = "http://localhost/mvc/admins";   
                document.querySelector("#Respuesta").innerHTML = this.responseText;
                const tbody = document.querySelector("#tbody-alumnos");
                const fila = document.querySelector("#fila-" + matricula);
                tbody.removeChild(fila);
            });
          }
                , function(){ alertify.error('Cancelado')});
    });
});

function httpRequest(url, callback) {
    const http = new XMLHttpRequest();
    http.open("GET", url);
    http.send();

    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback.apply(http);
        }
    }

}