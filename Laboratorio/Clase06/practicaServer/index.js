var xhr;
window.onload=function(){
    traerObjeto();
}

function traerObjeto(){
    xhr=new XMLHttpRequest();
    xhr.onreadystatechange=procesar;
   var cadena="http://localhost:3000/traer?collection=objeto";
    xhr.open('GET',cadena,true);
    xhr.send();
}

function procesar(){
    if(xhr.readyState==4)
    {
        if(xhr.status==2000)
        {
            console.log(JSON.parse(xhr.responseText));
        }
    }
}