const sliderPrincipal = document.querySelector("#contenedor_slider_items");
let sliderItemsPrincipal = document.querySelectorAll(".slider_item_principal");
let sliderPrincipalAnterior = sliderItemsPrincipal[sliderItemsPrincipal.length - 1];

const botonIzquieroSliderPrincipal = document.querySelector("#boton_izquierdo_slider_principal");
const botonDerechoSliderPrincipal = document.querySelector("#boton_derecho_slider_principal");

sliderPrincipal.insertAdjacentElement('afterbegin', sliderPrincipalAnterior);

function Siguiente() {
    let sliderSectionPrimero = document.querySelectorAll(".slider_item_principal")[0];
    sliderPrincipal.style.marginLeft = "-200%";
    sliderPrincipal.style.transition = "all 0.5s";
    setTimeout(function () {
        sliderPrincipal.style.transition = "none";
        sliderPrincipal.insertAdjacentElement('beforeend', sliderSectionPrimero);
        sliderPrincipal.style.marginLeft = "-100%";
    }, 500);
}

function Anterior() {
    let sliderItemsPrincipal = document.querySelectorAll(".slider_item_principal");
    let sliderSectionUltimo = sliderItemsPrincipal[sliderItemsPrincipal.length - 1];
    sliderPrincipal.style.marginLeft = "0";
    sliderPrincipal.style.transition = "all 0.5s";
    setTimeout(function () {
        sliderPrincipal.style.transition = "none";
        sliderPrincipal.insertAdjacentElement('afterbegin', sliderSectionUltimo);
        sliderPrincipal.style.marginLeft = "-100%";
    }, 500);
}

botonDerechoSliderPrincipal.addEventListener('click', function () {
    Siguiente();
});

botonIzquieroSliderPrincipal.addEventListener('click', function () {
    Anterior();
});

setInterval(function(){
    Siguiente()
}, 5000)