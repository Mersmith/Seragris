@if (count($productos))
    <div class="centrar_contenedor_slider_producto">
        <div id="contenedor_slider_producto">
            <h2 class="slider_producto_titulo">Productos más vendidos </h2>
            <div class="glider2">
                @php
                    $saludo = 'Quiero información de este producto';
                    $numeroCelular = config('services.wsp.numero');
                    $saltoLinea = '%0D%0A';
                @endphp

                @foreach ($productos as $key => $producto)
                    @php
                        $urlProducto = route('producto.index', $producto);
                        $textoMensaje = "$saludo:  $saltoLinea $saltoLinea -$producto->nombre a S/. $producto->precio
                        $saltoLinea $saltoLinea $urlProducto";
                    @endphp
                    <!--ITEM 1-->
                    <div class="item_slider_producto">
                        <div class="slider_producto_imagen">
                            <a href="{{ route('producto.index', $producto) }}">
                                @if ($producto->imagenes->count())
                                    <img src="{{ Storage::url($producto->imagenes->first()->imagen_ruta) }}"
                                        alt="" />
                                @else
                                    <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                @endif
                            </a>
                            <div class="opcion_cambiar">
                                Ver producto
                                <br>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <h2 class="slider_producto_nombre">{{ $producto->nombre }}</h2>
                            <p class="slider_producto_descripcion">{{ Str::limit($producto->descripcion, 35) }}</p>
                        </div>
                        <div style="text-align: center;">
                            <p class="slider_producto_precio">S/. {{ number_format($producto->precio, 0, '.', ',') }}
                            </p>
                            <button class="slider_producto_boton">
                                <a href="https://api.whatsapp.com/send/?phone={{$numeroCelular}}&text={{$textoMensaje}}&app_absent=0"
                                    target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Whatsapp
                                </a>
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>
            <button aria-label="Previous" class="boton_slider_producto glider-prev2">
                <i class="fa-solid fa-angle-left"></i>
            </button>
            <button aria-label="Next" class=" boton_slider_producto glider-next2">
                <i class="fa-solid fa-angle-right"></i>
            </button>
        </div>
    </div>
@endif

@push('script')
    <script>
        new Glider(document.querySelector('.glider2'), {
            slidesToShow: 5,
            slidesToScroll: 5,
            draggable: true,
            arrows: {
                prev: '.glider-prev2',
                next: '.glider-next2'
            },
            responsive: [{
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 640,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }, {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            }]
        });
    </script>
@endpush
