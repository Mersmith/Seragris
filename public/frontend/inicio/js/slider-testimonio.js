const sliderTestimonio = document.querySelector("#contenedor_slider_testimonio_items");
let sliderItemsTestimonio = document.querySelectorAll(".slider_testimonio_item");
let sliderTestimonioAnterior = sliderItemsTestimonio[sliderItemsTestimonio.length - 1];

const botonIzquieroSliderTestimonio = document.querySelector("#boton_izquierdo_slider_testimonio");
const botonDerechoSliderTestimonio = document.querySelector("#boton_derecho_slider_testimonio");

sliderTestimonio.insertAdjacentElement('afterbegin', sliderTestimonioAnterior);

function SiguienteTestimonio() {
    let sliderSectionPrimero = document.querySelectorAll(".slider_testimonio_item")[0];
    sliderTestimonio.style.marginLeft = "-200%";
    sliderTestimonio.style.transition = "all 0.5s";
    setTimeout(function () {
        sliderTestimonio.style.transition = "none";
        sliderTestimonio.insertAdjacentElement('beforeend', sliderSectionPrimero);
        sliderTestimonio.style.marginLeft = "-100%";
    }, 500);
}

function AnteriorTestimonio() {
    let sliderItemsTestimonio = document.querySelectorAll(".slider_testimonio_item");
    let sliderSectionUltimo = sliderItemsTestimonio[sliderItemsTestimonio.length - 1];
    sliderTestimonio.style.marginLeft = "0";
    sliderTestimonio.style.transition = "all 0.5s";
    setTimeout(function () {
        sliderTestimonio.style.transition = "none";
        sliderTestimonio.insertAdjacentElement('afterbegin', sliderSectionUltimo);
        sliderTestimonio.style.marginLeft = "-100%";
    }, 500);
}

botonDerechoSliderTestimonio.addEventListener('click', function () {
    SiguienteTestimonio();
});

botonIzquieroSliderTestimonio.addEventListener('click', function () {
    AnteriorTestimonio();
});

setInterval(function () {
    SiguienteTestimonio()
}, 10000)