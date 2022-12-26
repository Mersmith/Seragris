<div class="contenedor_slider_principal">
    <div class="contenedor_slider_items glider1" id="contenedor_slider_items">
        <!--Slider1-->
        <div class="slider_item_principal">
            <a>
                <img src="{{ asset('imagenes/slider/slider1.jpg') }}" class="slider_principal_imagen">
            </a>
        </div>
        <!--Slider2-->
        <div class="slider_item_principal">
            <a>
                <img src="{{ asset('imagenes/slider/slider2.jpg') }}" class="slider_principal_imagen">
            </a>
        </div>
        <!--Slider3-->
        <div class="slider_item_principal">
            <a>
                <img src="{{ asset('imagenes/slider/slider3.jpg') }}" class="slider_principal_imagen">
            </a>
        </div>
    </div>
    <button aria-label="Previous" id="boton_izquierdo_slider_principal" class="slider_principal_boton glider-prev-1">
        <i class="fa-solid fa-angle-left"></i>
    </button>
    <button aria-label="Next" id="boton_derecho_slider_principal" class="slider_principal_boton glider-next-1">
        <i class="fa-solid fa-angle-right"></i>
    </button>
    <div class="slider_principal_pie dots" role="tablist"></div>
</div>
<script>
    gliderAutoplay(
        new Glider(document.querySelector('.glider1'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: ".dots",
            arrows: {
                prev: '.glider-prev-1',
                next: '.glider-next-1'
            },
        }), {
            interval: 5000,
            onPause: function() {
                document.getElementById("status").innerHTML = "PAUSE";
            },
            onRestart: function() {
                document.getElementById("status").innerHTML = "RUN";
            },
        }
    );
</script>
