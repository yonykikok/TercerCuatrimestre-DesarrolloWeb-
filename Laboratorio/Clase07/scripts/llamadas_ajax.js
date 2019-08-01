var xhr;
window.addEventListener('load',function(){
    listaPersonas=LeerPersonas();

    document.getElementById('btnAgregar').addEventListener('click',LeerPersonas);
});

function generarTabla(lista){    
    var divTabla=document.getElementById('divTabla');
    var tabla=document.createElement('table');
    tabla.setAttribute('id','tablaPersonas');
    var parametros=Object.keys(lista[0]);
    var trHeader=document.createElement('tr');

    for(var i=0;i<parametros.length;i++)
    {
        var texto=document.createTextNode(parametros[i]);
        var td=document.createElement('td');
        td.appendChild(texto);
        trHeader.appendChild(td);
    }
    tabla.appendChild(trHeader);
    
    for(var i=0;i<lista.length;i++)
    {
        var tr=document.createElement('tr');
        for(var j=0;j<parametros.length;j++)
        {
            var texto=document.createTextNode(lista[i][parametros[j]]);
            var td=document.createElement('td');
            td.setAttribute('id',parametros[i]);
            td.appendChild(texto);
            tr.appendChild(td);
        }
        tr.addEventListener('click',rellenarCampos.bind(null,lista[i])); 
        tabla.appendChild(tr);
    }
    divTabla.appendChild(tabla);
}

function rellenarCampos(objeto){    
    //console.log(lista['first_name']);
    
    mostrarForm(objeto);
    document.getElementById('first_name').value=objeto['first_name'];
    document.getElementById('last_name').value=objeto['last_name'];
    document.getElementById('email').value=objeto['email'];
    document.getElementById('gender').value=objeto['gender'];
}