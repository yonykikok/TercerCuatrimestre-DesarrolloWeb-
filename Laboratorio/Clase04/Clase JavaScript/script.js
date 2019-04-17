function mostrarHoraActual()
{  
    var hora=new Date();
    hora="Actualizar Hora<br>"+hora.getHours() +":"+ hora.getMinutes()+":" + hora.getSeconds();
    document.getElementById("hora").innerHTML=hora;
}

// asigno a la variable x una funcion anonima
var x = function (a,b,c){
    if(!c)
    {
        c=0;
    }
    return a+b+c;
}
console.log(x(3,5));
//console.log(x(5));//muestro el valor de la variable x con el parametro 