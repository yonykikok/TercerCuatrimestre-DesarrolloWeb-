
function procesarLista() {
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
            var lista=(JSON.parse(xhr.response));
            //debugger;
            generarTabla(lista);
        }
    }
}
function procesarPersona() {

        if (xhr.readyState == 4) {
            //debugger;
            if (xhr.status == 200) {
                
                document.getElementById('spinner').style.display = "none";
                alert("persona agregada");
            }
            else{
                alert('ERROR');
            }
        } else {
            document.getElementById('spinner').style.display = "block";
        }
}

function mostrarForm(objeto) {
    var divFormPersona = document.getElementById('divFrm');
    divFormPersona.style.display = "block";//dejo de ocultarlo
    divFormPersona.innerHTML = "";//reseteo el div

    crearFormulario();
    //creo los EVENTO De los botones
    eventoDeBotones();

}
function eventoDeBotones(){

    document.getElementById('btnCancelar').addEventListener('click', function () {
        document.getElementById('divFrm').style.display = "none";
        event.preventDefault();
    })
    document.getElementById('btnAgregarPersona').addEventListener('click', function () {
        
        event.preventDefault();
        altaPersona();
    })
}

function altaPersona(){
    //var persona={"id":5,"first_name": document.getElementById('first_name').value, "last_name": document.getElementById('first_name').value, "email": document.getElementById('last_name').value, "gender": document.getElementById('email').value,"active":"true"}
    var objeto = { "id": 1, "first_name": "Walliw", "last_name": "Spurden", "email": "wspurden0@reverbnation.com", "gender": "Female", "active": "true" }
    //console.log(persona);
    //console.log(JSON.stringify(persona));
    agregar(objeto);
}
    
function crearFormulario() {
    formPersona = document.createElement('form');
    //creo los labels contenedores
    var labelName = document.createElement('label');
    var labelLastName = document.createElement('label');
    var labelEmail = document.createElement('label');
    var labelGender = document.createElement('label');
    //creo los inputs
    var inputName = document.createElement('input');
    var inputLastName = document.createElement('input');
    var inputEmail = document.createElement('input');
    var inputGender = document.createElement('input');

    //genero los label con los campos
    labelName.appendChild(document.createTextNode('Nombre'));
    labelLastName.appendChild(document.createTextNode('Apellido'));
    labelEmail.appendChild(document.createTextNode('Correo'));
    labelGender.appendChild(document.createTextNode('Sexo'));
    //agrego los input al label para ponerlos en paralelo
    labelName.appendChild(inputName);
    labelLastName.appendChild(inputLastName);
    labelEmail.appendChild(inputEmail);
    labelGender.appendChild(inputGender);
    //seteamos Id a cada campo del form
    inputName.setAttribute('id', 'first_name');
    inputLastName.setAttribute('id', 'last_name');
    inputEmail.setAttribute('id', 'email');
    inputGender.setAttribute('id', 'gender');
    //agregamos los label al form
    formPersona.appendChild(labelName);
    formPersona.appendChild(labelLastName);
    formPersona.appendChild(labelEmail);
    formPersona.appendChild(labelGender);

    //creamos los botones
    var addButton = document.createElement('button');
    var cancelButton = document.createElement('button');
    //le ponemos texto de vista
    addButton.appendChild(document.createTextNode('Agregar Persona'));
    cancelButton.appendChild(document.createTextNode('Cancelar'));
    //seteamos ID para los botones
    addButton.setAttribute('id', 'btnAgregarPersona');
    cancelButton.setAttribute('id', 'btnCancelar');
    //los agregamos al form
    formPersona.appendChild(addButton);
    formPersona.appendChild(cancelButton);
    //agregamos todo al div
    document.getElementById('divFrm').appendChild(formPersona);
}