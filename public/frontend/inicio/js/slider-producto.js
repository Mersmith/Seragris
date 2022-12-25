var contenedorSliderProducto = document.getElementById('contenedor_slider_producto')
var sliderProducto = document.getElementById('slider_producto');
var slidersProductos = document.getElementsByClassName('item_slider_producto').length;
var botonSliderProducto = document.getElementsByClassName('boton_slider_producto');

const botonSiguienteProducto = document.getElementById("boton_siguiente_producto");
const botonRetrocederProducto = document.getElementById("boton_retroceder_producto");

var posicionActual = 0;
var margenActual = 0;
var sliderPorPagina = 0;
var cantidadSliders = slidersProductos - sliderPorPagina;
var contenedorAncho = contenedorSliderProducto.offsetWidth;

window.onload = function () {
    const anchoCargado = window.innerWidth;
    cambiarParametro(anchoCargado);
}

window.addEventListener("resize", anchoPantalla);

function anchoPantalla() {
    contenedorAncho = contenedorSliderProducto.offsetWidth;
    cambiarParametro(contenedorAncho);
}

function cambiarParametro(ancho) {
    if (ancho < 551) {
        sliderPorPagina = 1;
    } else {
        if (ancho < 901) {
            sliderPorPagina = 2;
        } else {
            if (ancho < 1101) {
                sliderPorPagina = 3;
            } else {
                sliderPorPagina = 4;
            }
        }
    }
    cantidadSliders = slidersProductos - sliderPorPagina;
    if (posicionActual > cantidadSliders) {
        posicionActual -= sliderPorPagina;
    };
    margenActual = - posicionActual * (100 / sliderPorPagina);
    sliderProducto.style.marginLeft = margenActual + '%';
    if (posicionActual > 0) {
        botonSliderProducto[0].classList.remove('inactive');
    }
    if (posicionActual < cantidadSliders) {
        botonSliderProducto[1].classList.remove('inactive');
    }
    if (posicionActual >= cantidadSliders) {
        botonSliderProducto[1].classList.add('inactive');
    }
}

cambiarParametro();

function siguienteProducto() {
    if (posicionActual != 0) {
        sliderProducto.style.marginLeft = margenActual + (100 / sliderPorPagina) + '%';
        margenActual += (100 / sliderPorPagina);
        posicionActual--;
    };
    if (posicionActual === 0) {
        botonSliderProducto[0].classList.add('inactive');
    }
    if (posicionActual < cantidadSliders) {
        botonSliderProducto[1].classList.remove('inactive');
    }
};

function retrocederProducto() {
    if (posicionActual != cantidadSliders) {
        sliderProducto.style.marginLeft = margenActual - (100 / sliderPorPagina) + '%';
        margenActual -= (100 / sliderPorPagina);
        posicionActual++;
    };
    if (posicionActual == cantidadSliders) {
        botonSliderProducto[1].classList.add('inactive');
    }
    if (posicionActual > 0) {
        botonSliderProducto[0].classList.remove('inactive');
    }
};

botonSiguienteProducto.addEventListener('click', function () {
    siguienteProducto();
});

botonRetrocederProducto.addEventListener('click', function () {
    retrocederProducto();
});
