<div class="contenedor_slider_principal">
    <div class="contenedor_slider_items glider1" id="contenedor_slider_items">
        @foreach ($sliders as $slider)
            <div class="slider_item_principal">
                @if ($slider->link)
                    <a href="//{{ $slider->link }}" target="_blank">
                        <img src="{{ Storage::url($slider->imagenes->first()->imagen_ruta) }}"
                            class="slider_principal_imagen">
                    </a>
                @else
                    <a>
                        <img src="{{ Storage::url($slider->imagenes->first()->imagen_ruta) }}"
                            class="slider_principal_imagen">
                    </a>
                @endif
            </div>
        @endforeach
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
            /*onPause: function() {
                document.getElementById("status").innerHTML = "PAUSE";
            },
            onRestart: function() {
                document.getElementById("status").innerHTML = "RUN";
            },*/
        }
    );
</script>
