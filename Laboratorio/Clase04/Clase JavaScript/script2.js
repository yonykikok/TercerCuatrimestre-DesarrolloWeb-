var miParrafo;
window.addEventListener('load', inicializarEventos);

function inicializarEventos(){
    miParrafo=document.getElementById('p1');
    miParrafo.addEventListener('click',function(){
        this.innerHTML="MANEJE EL EVENTO";
    });
}



