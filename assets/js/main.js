function cargarEventos() {

    if (document.getElementById("Pais")) {
        getProvincias(document.getElementById("Pais").value);
        document.getElementById("Pais").addEventListener("change", function () {
            getProvincias(document.getElementById("Pais").value);
        });
    }

    if (document.getElementById("Provincia")) {
        document.getElementById("Provincia").addEventListener("change", function () {
            getLocalidades(document.getElementById("Provincia").value);
        });
    }




}

function getProvincias(idPais) {

    if (idPais !== "-1") {

        // creo el objeto que realizara la llamada
        let llamada = new XMLHttpRequest();

        // url del php a llamar
        let url = "load-data.php";

        // Creo los parámetros que voy a insertar
        let parametros = {
            "metodo": "provincias",
            "idpais": idPais
        };

        // Indico los parámetros que voy a mandar
        let params = "data=" + JSON.stringify(parametros);

        // Función que se ejecutará al recibir la respuesta
        llamada.onreadystatechange = function () {
            // si todo está bien
            if (this.readyState === 4 && this.status === 200) {

                let data = this.responseText.substr(0, this.responseText.indexOf("]")+1)

                let datos = JSON.parse(data);

                let selectProvincia = document.getElementById("Provincia");
                selectProvincia.innerHTML = ""; // Limpiar
                datos.forEach(dato => {
                    let option = document.createElement("option");
                    option.setAttribute("value", dato.id_provincia);
                    let contoption = document.createTextNode(dato.nombre);

                    option.appendChild(contoption);
                    selectProvincia.appendChild(option);


                });

                getLocalidades(datos[0].id_provincia);

            }
        }

        // Indico que es una petición POST
        llamada.open("POST", url, true);
        // Esta línea es necesaria en una petición POST
        llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        llamada.send(params); // Le paso los parámetros
    } else {
        let selectProvincia = document.getElementById("Provincia");
        selectProvincia.innerHTML = ""; // Limpiar
        let selectLocalidad = document.getElementById("Localidad");
        selectLocalidad.innerHTML = ""; // Limpiar
    }

}


function getLocalidades(idProvincia) {

    // creo el objeto que realizara la llamada
    let llamada = new XMLHttpRequest();

    // url del php a llamar
    let url = "load-data.php";

    // Creo los parámetros que voy a insertar
    let parametros = {
        "metodo": "localidades",
        "idprovincia": idProvincia
    };

    // Indico los parámetros que voy a mandar
    let params = "data=" + JSON.stringify(parametros);

    // Función que se ejecutará al recibir la respuesta
    llamada.onreadystatechange = function () {
        // si todo está bien
        if (this.readyState === 4 && this.status === 200) {

            let data = this.responseText.substr(0, this.responseText.indexOf("]")+1)

            let datos = JSON.parse(data);

            let selectLocalidad = document.getElementById("Localidad");
            selectLocalidad.innerHTML = ""; // Limpiar
            datos.forEach(dato => {
                let option = document.createElement("option");
                option.setAttribute("value", dato.id_localidad);
                let contoption = document.createTextNode(dato.nombre);

                option.appendChild(contoption);
                selectLocalidad.appendChild(option);


            });

        }
    }

    // Indico que es una petición POST
    llamada.open("POST", url, true);
    // Esta línea es necesaria en una petición POST
    llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    llamada.send(params); // Le paso los parámetros


}

window.onload = cargarEventos;