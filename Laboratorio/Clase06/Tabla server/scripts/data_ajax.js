//Enviar peticion GET a http://localhost:3000/traer
//pasar parametro "collection"  con valor "personas"  
//La respuesta sera un array con las personas
var xhr;
var DivPersonas;
var btnIniciarSesion;
var form;
window.onload=function(){
    document.getElementById('btnIniciarSesion').addEventListener('click',verificarUsuario);

}

function verificarUsuario()
{
    var usuario=document.getElementById('inputUsuario').value;
    var password=document.getElementById('inputPassword').value;
    form=document.getElementById('formLogin');
    form.style.display='none';
    traerObjeto("personas");

}

function traerObjeto(collection){
    xhr=new XMLHttpRequest();
    xhr.onreadystatechange=procesar;
    var cadena="http://localhost:3000/traer?collection="+collection;
    xhr.open('GET',cadena,true);
    xhr.send();
}

function procesar()
{
    if(xhr.readyState==4)
    {
        if(xhr.status==200)
        {                
            document.getElementById('spinner').style.display="none";
            DivPersonas=document.createElement('div');
            document.body.appendChild(DivPersonas);            
            CreandoTabla(JSON.parse(xhr.responseText),DivPersonas);
        }
        else
        {
            alert("Error, "+xhr.status);
        }
    }
    else
    {       
        if(xhr.readyState==1)
        {
           document.getElementById('spinner').style.display="inline-block";
        }/*
        else if(xhr.readyState==2)
        {
            alert("1");
        }
        else if(xhr.readyState==3)
        {
            alert("2");
        }
        else if(xhr.readyState==4)
        {
            alert("3");
        }*/
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