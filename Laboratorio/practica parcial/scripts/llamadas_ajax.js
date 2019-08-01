var xhr;
var host="http://localhost:3000/";
var listaDeParametros;
window.addEventListener('load',function(){   
    document.getElementById('btnAgregar').addEventListener('click',traerPersona);
   
       

});

function traerPersona(){
    var collection="personas";
    var url ="http://localhost:3000/traer?collection="+collection;
    xhr= new XMLHttpRequest();
    xhr.onreadystatechange=procesarPersona;
    xhr.open("GET",url,true);
    xhr.send();
}

function agregar(objeto){
    var body={"collection": "personas",
    "objeto": objeto
    }
    var url ="http://localhost:3000/agregar";
    xhr= new XMLHttpRequest();
    xhr.onreadystatechange=procesarPersona;
    xhr.open("POST",url,true);
    xhr.send(JSON.stringify(body));
}