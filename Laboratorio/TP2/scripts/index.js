var labelBuscador;
var btnBuscar;
var miString = JSON.stringify(data);
var listaObjetos=JSON.parse(miString);
window.addEventListener("load",function(){            
    var divTablaPrincipal=document.getElementById('DivTablaPrincipal');
    labelBuscador=document.getElementById('labelBuscador');
    btnBuscar=document.getElementById('btnBuscar');
    
    CreandoTabla(listaObjetos,divTablaPrincipal); 

    btnBuscar.addEventListener('click',function(){      
          
        div=document.getElementById('DivTablaPrincipal');
        div.innerHTML="";
        var dato=labelBuscador.value;        
        if(dato=="")
        {
            CreandoTabla(listaObjetos,divTablaPrincipal);            
        }
        else
        {
            
            seleccionado();
        }
    });

    labelBuscador.addEventListener('click',function(){
       this.setAttribute("value","");
    });

});

function seleccionado() 
{ 
    var datoCheckeado = document.getElementsByName("dato");//obtengo la lista de checksbuttoms por medio del Name
    var datoSeleccionado;
    
    for(var i = 0; i < datoCheckeado.length; i++) {
       if(datoCheckeado[i].checked)
       {
        datoSeleccionado = datoCheckeado[i].id;//el dato seleccionado va a ser igual al nombre de Id          
           CreandoTablaFiltradaPorDato(listaObjetos,div,datoSeleccionado);//se busca por ese dato
       }
     }
}
function CreandoTablaFiltradaPorDato(listaObjetos,miDiv,buscarPor)//se le pasa la lista de objetos, el Div que contendra la tabla y el nombre para agregarlos
{       
    var tabla =document.createElement('table');
    miDiv.appendChild(tabla);     

    CrearHeaderDeTablaObject(tabla,listaObjetos[0]);
    if(buscarPor=="id")
    {
        for(var i=0;i<listaObjetos.length;i++)
        {  
            if(listaObjetos[i][buscarPor]==labelBuscador.value)
            {
                CrearTdObjeto(tabla,listaObjetos[i]);
            }            
           
        }
    }
    else
    {   
        for(var i=0;i<listaObjetos.length;i++)
        {  
            if(listaObjetos[i][buscarPor].toLowerCase()==labelBuscador.value.toLowerCase())
            {
                CrearTdObjeto(tabla,listaObjetos[i]);
            }           
           
        }
    }
        
}

function CreandoTabla(listaObjetos,miDiv)//se le pasa la lista de objetos y el Div que contendra la tabla
{       
    //Creando la tabla
    var tabla =document.createElement('table');
        
    miDiv.appendChild(tabla);     

    CrearHeaderDeTablaObject(tabla,listaObjetos[0]);

    for(var i=0;i<listaObjetos.length;i++)
    {  
        CrearTdObjeto(tabla,listaObjetos[i]);
    }
}

function CrearTdObjeto(tabla,objeto)//Usamos esta para hacerlo Generico
{
    var listaDeParametros=Object.keys(objeto);//obtiene un array con las keys 
    tr =document.createElement('tr');//creamos la row para los datos
    for(var i=0;i<listaDeParametros.length;i++)//recorro tantas veces como keys tenga
    {
        var campo=listaDeParametros[i];
        td=document.createElement('td');     
        texto=document.createTextNode(objeto[campo]);
        td.appendChild(texto);
        tr.appendChild(td);
    }
    tabla.appendChild(tr);
}
function CrearHeaderDeTablaObject(tabla,objeto)
{    
    var listaDeParametros=Object.keys(objeto);//obtiene un array con las keys 
   
    trHeader =document.createElement('tr'); //creamos la head de la tabla
    
    for(var i=0;i<listaDeParametros.length;i++)
    {
        var campo=listaDeParametros[i];
        td=document.createElement('td');     
        texto=document.createTextNode(campo);
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