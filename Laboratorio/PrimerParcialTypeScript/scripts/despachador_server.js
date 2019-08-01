var xhr;
$(function() {
    traerPersonas();
})

function traerPersonas() {
    $.ajax({
        url: "http://localhost:3000/traer?collection=personas",
        beforeSend: function() {
            $("#divSpinner").html('<img src="./images/spinner.gif" alt="spinner gif">');
        },
        success: function(respuesta) {
            actualizarLista(respuesta['data']);
        },
        error: function(xhr, status) {
            alert("ERROR " + xhr.status + " " + xhr.statusText);
        },
        complete: function(xhr, status) {
            //alert("Peticion Terminada");
            $("#divSpinner").html("");
        }
    });
}

function actualizarLista(lista) {
    arraydeParametros = Object.keys(lista[1]);
    $('#bodyTabla').html('');
    lista.map((persona) => {
        var tr = document.createElement('tr');
        arraydeParametros.map((atributo, indice, array) => {
            var td = document.createElement('td');
            var texto = document.createTextNode(persona[atributo]);
            td.appendChild(texto);
            tr.appendChild(td);
        });

        tr.addEventListener('click', generarForm.bind(null, persona));
        $('#bodyTabla').append(tr);
    });

}

function generarForm(persona) {
    document.getElementById('formAltaPersona').innerHTML = "";
    var arrayDeParametros = Object.keys(persona);
    var form = document.createElement('form');
    form.setAttribute('id', 'formAltaPersona');
    arrayDeParametros.map((campo) => {
        var label;
        switch (campo) {
            case 'first_name':
                label = GenerarInput(document.createTextNode(campo), document.createTextNode(persona[campo]), 'text', 'form-control', 'ingresa tu nombre');
                break;
            case 'last_name':
                label = GenerarInput(document.createTextNode(campo), document.createTextNode(persona[campo]), 'text', 'form-control', 'ingresa tu apellido');
                break;
            case 'email':
                label = GenerarInput(document.createTextNode(campo), document.createTextNode(persona[campo]), 'email', 'form-control', 'ingresa tu email');
                break;
            case 'gender':
                label = GenerarInput(document.createTextNode(campo), document.createTextNode(persona[campo]), 'checkbox', 'form-check-input', 'ingresa tu email');
                break;
            case 'active':
                label = GenerarInput(document.createTextNode(campo), document.createTextNode(persona[campo]), 'checkbox', 'form-check-input', 'ingresa tu email');
                break;

        }
        if (label)
            form.appendChild(label);
    });
    $('#formAltaPersona').append(form);


}

function GenerarInput(textoLabel, textoValue, inputType, inputClass, placeHolder) {
    var label = document.createElement('label');
    label.appendChild(textoLabel);
    var input = document.createElement('input');
    input.setAttribute('type', inputType);
    input.setAttribute('class', inputClass);
    input.setAttribute('placeholder', placeHolder);
    input.appendChild(textoValue);
    label.appendChild(input);
    return label;
}

function GenerarInputCheckBox(textoLabel, textoValue, inputType, inputClass) {
    var label = document.createElement('label');
    label.appendChild(textoLabel);
    var input = document.createElement('input');
    input.setAttribute('type', inputType);
    input.setAttribute('class', inputClass);
    input.appendChild(textoValue);
    label.appendChild(input);
    return label;
}

function guardarPersona(persona) {
    event.preventDefault();
    var legajo = $("#txtLegajo").val();
    var nombre = $("#txtNombre").val();
    var parametros = {
        "legajo": legajo,
        "nombre": nombre
    };
    $.post("http://localhost:3000/loadpost", function(respuesta) {
        console.log(respuesta);
    })

    $.post("http://localhost:3000/saludo", parametros, function(respuesta) {
        console.log(respuesta);
    })
}


function eliminarPersona(id) {}

function modificarPersona(persona) {

}