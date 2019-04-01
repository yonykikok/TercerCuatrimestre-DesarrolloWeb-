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
        modalLogin.setAttribute('open', true);
    })

    btnCerrar.addEventListener('click', () => {
        modalLogin.removeAttribute('open');
    })

    btnRegistrarse.addEventListener('click', () => {
        modalRegistrarse.setAttribute('open', true);
    })

    btnCancelar.addEventListener('click', () => {
        modalRegistrarse.removeAttribute('open');

    })


})