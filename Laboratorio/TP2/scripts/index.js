var labelBuscador;
var btnBuscar;
var miString = JSON.stringify(data);
var listaObjetos = JSON.parse(miString);
var lecturaTr;
window.addEventListener("load", function() {
    var divTablaPrincipal = document.getElementById('DivTablaPrincipal');
    labelBuscador = document.getElementById('labelBuscador');
    btnBuscar = document.getElementById('btnBuscar');
    lecturaTr = document.getElementsByTagName('tr');

    CreandoTabla(listaObjetos, divTablaPrincipal);

    //boton buscar
    btnBuscar.addEventListener('click', function() {

        div = document.getElementById('DivTablaPrincipal');
        div.innerHTML = "";
        var dato = labelBuscador.value;
        if (dato == "") {
            CreandoTabla(data, divTablaPrincipal);
        } else {

            seleccionado(); //checkButton seleccionado.
        }
    });

    //label buscar
    labelBuscador.addEventListener('click', function() {
        this.setAttribute("value", "");
    });

    var table = document.getElementById("DivTablaPrincipal")

    //obtener datos de linea al Clickear
    table.addEventListener("click", ObtenerInformacionDeLinea);

    var btnModificar = document.getElementById('btnModificar');
    btnModificar.addEventListener('click', function() {
        var auxId = document.getElementById('idFormPersona').value;
        modificarPersona(data, auxId);
    })

});

function modificarPersona(data, id) {
    auxName = document.getElementById('first_nameFormPersona').value;
    auxLastName = document.getElementById('last_nameFormPersona').value;
    auxEmail = document.getElementById('emailFormPersona').value;
    auxGender = document.getElementById('genderFormPersona').value;
    auxIpAddress = document.getElementById('ip_addressFormPersona').value;
    for (var i = 0; i < data.length; i++) {
        if (data[i]['id'] == id) {
            alert(data[i]['first_name'] + "->" + auxName);
            data[i]['first_name'] = auxName;
            data[i]['last_name'] = auxLastName;
            data[i]['email'] = auxEmail;
            data[i]['gender'] = auxGender;
            data[i]['ip_address'] = auxIpAddress;
        }
    }
}

function ObtenerInformacionDeLinea() {
    var tds = event.path[1].children
    var datos = []; //array donde guardaremos los datos
    for (var i = 0; i < tds.length; i++) {
        datos.push(tds[i].innerText) //se guardan los datos de la linea en el array
    }

    if (datos.length == 6) //si lo que se clickea es una linea, llena el form Persona de lo contrario no ahce nada
    {
        cargarElFormPersona(datos);
    }
}

function cargarElFormPersona(datos) {
    document.getElementById('idFormPersona').value = datos[0];
    document.getElementById('first_nameFormPersona').value = datos[1];
    document.getElementById('last_nameFormPersona').value = datos[2];
    document.getElementById('emailFormPersona').value = datos[3];
    document.getElementById('genderFormPersona').value = datos[4];
    document.getElementById('ip_addressFormPersona').value = datos[5];
}

function seleccionado() {
    var datoCheckeado = document.getElementsByName("dato"); //obtengo la lista de checksbuttoms por medio del Name
    var datoSeleccionado;

    for (var i = 0; i < datoCheckeado.length; i++) {
        if (datoCheckeado[i].checked) {
            datoSeleccionado = datoCheckeado[i].id; //el dato seleccionado va a ser igual al nombre de Id          
            CreandoTablaFiltradaPorDato(listaObjetos, div, datoSeleccionado); //se busca por ese dato
        }
    }
}

function CreandoTablaFiltradaPorDato(listaObjetos, miDiv, buscarPor) //se le pasa la lista de objetos, el Div que contendra la tabla y el nombre para agregarlos
{
    var tabla = document.createElement('table');
    miDiv.appendChild(tabla);

    CrearHeaderDeTablaObject(tabla, listaObjetos[0]);
    if (buscarPor == "id") {
        for (var i = 0; i < listaObjetos.length; i++) {
            if (listaObjetos[i][buscarPor] == labelBuscador.value) {
                CrearTdObjeto(tabla, listaObjetos[i]);
            }

        }
    } else {
        for (var i = 0; i < listaObjetos.length; i++) {
            if (listaObjetos[i][buscarPor].toLowerCase() == labelBuscador.value.toLowerCase()) {
                CrearTdObjeto(tabla, listaObjetos[i]);
            }

        }
    }

}

function CreandoTabla(listaObjetos, miDiv) //se le pasa la lista de objetos y el Div que contendra la tabla
{
    //Creando la tabla
    var tabla = document.createElement('table');

    miDiv.appendChild(tabla);

    CrearHeaderDeTablaObject(tabla, listaObjetos[0]);

    for (var i = 0; i < listaObjetos.length; i++) {
        CrearTdObjeto(tabla, listaObjetos[i]);
    }
}

function CrearTdObjeto(tabla, objeto) //Usamos esta para hacerlo Generico
{
    var listaDeParametros = Object.keys(objeto); //obtiene un array con las keys 
    tr = document.createElement('tr'); //creamos la row para los datos
    for (var i = 0; i < listaDeParametros.length; i++) //recorro tantas veces como keys tenga
    {
        var campo = listaDeParametros[i];
        td = document.createElement('td');
        texto = document.createTextNode(objeto[campo]);
        td.appendChild(texto);
        tr.appendChild(td);
    }
    tabla.appendChild(tr);
}

function CrearHeaderDeTablaObject(tabla, objeto) {
    var listaDeParametros = Object.keys(objeto); //obtiene un array con las keys 

    trHeader = document.createElement('tr'); //creamos la head de la tabla

    for (var i = 0; i < listaDeParametros.length; i++) {
        var campo = listaDeParametros[i];
        td = document.createElement('td');
        texto = document.createTextNode(campo);
        td.appendChild(texto);
        trHeader.appendChild(td);
    }
    tabla.appendChild(trHeader);
}
/*
function CrearTDDePersona(tabla,persona)
{
    //creamos la head de la tabla
    tr =document.createElement('tr');
    tdId =document.createElement('td');
    tdFirstName =document.createElement('td');
    tdLastName =document.createElement('td');
    tdEmail =document.createElement('td');
    tdGender =document.createElement('td');
    tdIpAddress =document.createElement('td');

    textoId=document.createTextNode(persona.id);
    textoFirstName=document.createTextNode(persona.first_name);
    textoLastName=document.createTextNode(persona.last_name);
    textoEmail=document.createTextNode(persona.email);
    textoGender=document.createTextNode(persona.gender);
    textoIpAddress=document.createTextNode(persona.ip_address);

    tdId.appendChild(textoId);
    tdFirstName.appendChild(textoFirstName);
    tdLastName.appendChild(textoLastName);
    tdEmail.appendChild(textoEmail);
    tdGender.appendChild(textoGender);
    tdIpAddress.appendChild(textoIpAddress);
    tabla.appendChild(tr);
    tr.appendChild(tdId);
    tr.appendChild(tdFirstName);
    tr.appendChild(tdLastName);
    tr.appendChild(tdEmail);
    tr.appendChild(tdGender);
    tr.appendChild(tdIpAddress);
    //----------------------------
}

function CrearHeaderDeTabla(tabla)
{
    //creamos la head de la tabla
    trHeader =document.createElement('tr');
    
    tdId =document.createElement('td');
    tdFirstName =document.createElement('td');
    tdLastName =document.createElement('td');
    tdEmail =document.createElement('td');
    tdGender =document.createElement('td');
    tdIpAddress =document.createElement('td');

    textoId=document.createTextNode("ID");
    textoFirstName=document.createTextNode("First Name");
    textoLastName=document.createTextNode("Last Name");
    textoEmail=document.createTextNode("Email");
    textoGender=document.createTextNode("Gender");
    textoIpAddress=document.createTextNode("Ip Address");

    tdId.appendChild(textoId);
    tdFirstName.appendChild(textoFirstName);
    tdLastName.appendChild(textoLastName);
    tdEmail.appendChild(textoEmail);
    tdGender.appendChild(textoGender);
    tdIpAddress.appendChild(textoIpAddress);
    tabla.appendChild(trHeader);
    trHeader.appendChild(tdId);
    trHeader.appendChild(tdFirstName);
    trHeader.appendChild(tdLastName);
    trHeader.appendChild(tdEmail);
    trHeader.appendChild(tdGender);
    trHeader.appendChild(tdIpAddress);
    //----------------------------
}*/