window.addEventListener('load',inicializarEventos);

function inicializarEventos()
{
    document.getElementById('btnTabla').addEventListener('click',cargarTabla);    
}

function cargarTabla(){
    var divTablaPrincipal = document.getElementById('info');
    divTablaPrincipal.innerHTML=" ";
    CreandoTabla(personas,divTablaPrincipal);  
}
function CreandoTabla(listaObjetos, miDiv) //se le pasa la lista de objetos y el Div que contendra la tabla
{
    //Creando la tabla
    var tabla = document.createElement('table');
  //  tabla.setAttribute('border','3px solid blue');
    miDiv.appendChild(tabla);

    CrearHeaderDeTablaObject(tabla, listaObjetos[0]);

    for (var i = 0; i < listaObjetos.length; i++) {
        CrearTdObjeto(tabla, listaObjetos[i]);
    }
}

function CrearTdObjeto(tabla, objeto) //Usamos esta para hacerlo Generico
{
    var listaDeParametros = Object.keys(obtenerObjetoConMasParametros(personas)); //obtiene un array con las keys 
    tr = document.createElement('tr'); //creamos la row para los datos
    for (var i = 0; i < listaDeParametros.length; i++) //recorro tantas veces como keys tenga
    {
        var campo = listaDeParametros[i];
        td = document.createElement('td');
        if(typeof(objeto[campo])=='undefined')// si el campo no esta definido 
        {   
            texto = document.createTextNode("");
        }
        else
        {
            texto = document.createTextNode(objeto[campo]);
        }
        td.appendChild(texto);
        tr.appendChild(td);
    }
    tabla.appendChild(tr);
}
function obtenerObjetoConMasParametros(lista)
{
    var max=-1;
    var objetoConMasParametros;
    for (var i = 0; i < lista.length; i++) 
    {
        
        var listaDeParametros = Object.keys(lista[i]);
        if(max=-1){
            max=listaDeParametros.length;
            objetoConMasParametros=lista[i];
        }
        if(listaDeParametros.length>max)
        {
            max=listaDeParametros.length;
            objetoConMasParametros=lista[i];
        }
    }
    return objetoConMasParametros;
}

function CrearHeaderDeTablaObject(tabla, objeto) {
   // var listaDeParametros = Object.keys(objeto); //obtiene un array con las keys 
    var listaDeParametros = Object.keys(obtenerObjetoConMasParametros(personas)); //obtiene un array con las keys 
    
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