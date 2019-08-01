//Agregar el codigo necesario para cargar un array de objetos en una tabla html(se prohibe usar innerHTML)
//Agregar evento a todos los TD. conseguir los TD con una funcion recursiva que reciba como parametros, el body del HTML, y
//la funcion que asigna el manejador(la tabla ya debera ser parte del DOM).
//Agregar algun estilo por codigo JS
//Agregar algun estilo por hoja de estilo CSS

//Agregar el codigo necesario para realizar un ABM de personas(usando AJAX)
/*
traer:
HTTP:GET
URL:http://localhost:3000/traer
PARAMS: collection=personas
RTA: ARRAY DE PERSONAS

agregar:
HTTP:POST
URL:http://localhost:3000/agregar
PARAMS: {collection: 'personas',objeto:<persona>}
REQUEST HEADER: xhr.setRequestHeader('Content-Type', 'application/json');
RTA:{message: "Alta exitosa"}

modificar:
HTTP:POST
URL:http://localhost:3000/modificar
PARAMS: {collection: 'personas',objeto:<persona>}
REQUEST HEADER: xhr.setRequestHeader('Content-Type', 'application/json');
RTA:"Modificacion exitosa"

eliminar:
HTTP:POST
URL:http://localhost:3000/eliminar
PARAMS: {'collection':'personas','id' : <id>}
REQUEST HEADER: xhr.setRequestHeader('Content-Type', 'application/json');
RTA:{"message":"Baja exitosa"}

*/

//NOTA: EL REQUEST HEADER SE AGREGA UNA VEZ ABIERTA LA CONEXION

function LeerPersonas() {
    var collection="personas"
    var url="http://localhost:3000/traer?collection="+collection;
    xhr=new XMLHttpRequest();
    xhr.onreadystatechange=procesarLista;
    xhr.open('GET',url,true);
    xhr.send();
}
function agregar(persona)
{
  var url = "http://localhost:3000/agregar";
  xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = procesarPersona;

  var requestBody = {
    collection: "personas",
    objeto: persona
  };

  xhr.send(JSON.stringify(requestBody));
}