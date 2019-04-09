var btnLogin;
var modalLogin;
var btnCerrar;
var btnRegistrarse;
window.addEventListener('load', () => {

    btnLogin = document.getElementById('btnLogin');
    modalLogin = document.getElementById('modalLogin');
    btnCerrar = document.getElementById('btnCerrar');

    btnRegistrarse = document.getElementById('btnRegistrar');
    btnCancelar = document.getElementById('btnCancelar');

    btnLogin.addEventListener('click', () => {
        if(modalRegistrarse.open==false)
        {
            modalLogin.setAttribute('open', true); 
        }
        else
        {
            modalRegistrarse.removeAttribute('open');  
            modalLogin.setAttribute('open', true); 
        }  
        })

    btnCerrar.addEventListener('click', () => {

        modalLogin.removeAttribute('open');
    })

    btnRegistrarse.addEventListener('click', () => {
        if(modalLogin.open==false)
        {        
            modalRegistrarse.setAttribute('open', true);    
        }
        else
        {
            modalLogin.removeAttribute('open');
            modalRegistrarse.setAttribute('open', true);   
        }
    })

    btnCancelar.addEventListener('click', () => {
        modalRegistrarse.removeAttribute('open');

    })


})