var contenedorSliderProducto2 = document.getElementById('contenedor_slider_producto2')
var sliderProducto2 = document.getElementById('slider_producto2');
var slidersProductos2 = document.getElementsByClassName('item_slider_producto2').length;
var botonSliderProducto2 = document.getElementsByClassName('boton_slider_producto2');

const botonSiguienteProducto2 = document.getElementById("boton_siguiente_producto2");
const botonRetrocederProducto2 = document.getElementById("boton_retroceder_producto2");

var posicionActual2 = 0;
var margenActual2 = 0;
var sliderPorPagina2 = 0;
var cantidadSliders2 = slidersProductos2 - sliderPorPagina2;
var contenedorAncho2 = contenedorSliderProducto2.offsetWidth;

window.onload = function () {
    const anchoCargado2 = window.innerWidth;
    cambiarParametro2(anchoCargado2);
}

window.addEventListener("resize", anchoPantalla2);

function anchoPantalla2() {
    contenedorAncho2 = contenedorSliderProducto2.offsetWidth;
    cambiarParametro2(contenedorAncho2);
}

function cambiarParametro2(ancho2) {
    if (ancho2 < 551) {
        sliderPorPagina2 = 1;
    } else {
        if (ancho2 < 901) {
            sliderPorPagina2 = 2;
        } else {
            if (ancho2 < 1101) {
                sliderPorPagina2 = 3;
            } else {
                sliderPorPagina2 = 4;
            }
        }
    }
    cantidadSliders2 = slidersProductos2 - sliderPorPagina2;
    if (posicionActual2 > cantidadSliders2) {
        posicionActual2 -= sliderPorPagina2;
    };
    margenActual2 = - posicionActual2 * (100 / sliderPorPagina2);
    sliderProducto2.style.marginLeft = margenActual2 + '%';
    if (posicionActual2 > 0) {
        botonSliderProducto2[0].classList.remove('inactive');
    }
    if (posicionActual2 < cantidadSliders2) {
        botonSliderProducto2[1].classList.remove('inactive');
    }
    if (posicionActual2 >= cantidadSliders2) {
        botonSliderProducto2[1].classList.add('inactive');
    }
}

cambiarParametro2();

function siguienteProducto2() {
    if (posicionActual2 != 0) {
        sliderProducto2.style.marginLeft = margenActual2 + (100 / sliderPorPagina2) + '%';
        margenActual2 += (100 / sliderPorPagina2);
        posicionActual2--;
    };
    if (posicionActual2 === 0) {
        botonSliderProducto2[0].classList.add('inactive');
    }
    if (posicionActual2 < cantidadSliders2) {
        botonSliderProducto2[1].classList.remove('inactive');
    }
};

function retrocederProducto2() {
    if (posicionActual2 != cantidadSliders2) {
        sliderProducto2.style.marginLeft = margenActual2 - (100 / sliderPorPagina2) + '%';
        margenActual2 -= (100 / sliderPorPagina2);
        posicionActual2++;
    };
    if (posicionActual2 == cantidadSliders2) {
        botonSliderProducto2[1].classList.add('inactive');
    }
    if (posicionActual2 > 0) {
        botonSliderProducto2[0].classList.remove('inactive');
    }
};

botonSiguienteProducto2.addEventListener('click', function () {
    siguienteProducto2();
});

botonRetrocederProducto2.addEventListener('click', function () {
    retrocederProducto2();
});
