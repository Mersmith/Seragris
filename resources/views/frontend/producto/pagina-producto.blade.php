<x-frontend-layout>
    @section('tituloPagina', 'Producto | ' . $producto->nombre)
    <div class="contenedor_pagina_producto">
        <div class="contenedor_centrar_pagina">
            <div class="contenedor_info_producto">
                <!--Imagen-->
                <div class="contenedor_producto_imagen">
                    @if ($producto->imagenes->count())
                        <div>
                            <div class="contenedor_imagen_producto_principal">
                                <img src="{{ Storage::url($producto->imagenes->first()->imagen_ruta) }}" alt="">
                            </div>
                        </div>
                    @else
                        <div class="contenedor_imagen_producto_principal">
                            <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                        </div>
                    @endif
                </div>
                <!--Informacion-->
                <div class="contenedor_producto_info">

                    <p style="font-size: 13px; text-transform: uppercase; color: rgb(153, 153, 153);">PRODUCTOS >
                        {{ $producto->subcategoria->categoria->nombre }} >
                        <span style="color: #12866f;">{{ $producto->subcategoria->nombre }}</span>
                    </p>
                    <h1>{{ $producto->nombre }} </h1>
                    <p class="producto_info_precio">S/.{{ number_format($producto->precio, 2, '.', ',') }}
                        @if ($producto->precio !== $producto->precio_real)
                            <span>Antes<span style="text-decoration:line-through;">
                                    S/.{{ number_format($producto->precio_real, 2, '.', ',') }}</span></span>
                        @endif
                    </p>
                    <!--informacion-->
                    <div class="informacion_producto">
                        <p style="margin: 5px 0px;"><strong>Información del producto:</strong> </p>
                        <p>{!! html_entity_decode($producto->informacion) !!}</p>
                    </div>
                    @if ($producto->controla)
                        <!--controla-->
                        <div class="informacion_producto caracteristica_producto">
                            <div>
                                <img style="width: 50px; height: 50px;"
                                    src="{{ asset('imagenes/producto/controla.png') }}">
                            </div>
                            <div>
                                <p style="margin: 5px 0px; color: #12866f;"><strong>Controla</strong> </p>
                                <p>{!! html_entity_decode($producto->controla) !!}</p>
                            </div>
                        </div>
                    @endif
                    @if ($producto->cultivos)
                        <!--cultivos-->
                        <div class="informacion_producto caracteristica_producto">
                            <div>
                                <img style="width: 50px; height: 50px;"
                                    src="{{ asset('imagenes/producto/cultivo.png') }}">
                            </div>
                            <div>
                                <p style="margin: 5px 0px; color: #12866f;"><strong>Cultivos en los que se usa</strong>
                                </p>
                                <p>{!! html_entity_decode($producto->cultivos) !!}</p>
                            </div>
                        </div>
                    @endif
                    @if ($producto->ingredientes)
                        <!--ingredientes-->
                        <div class="informacion_producto caracteristica_producto">
                            <div>
                                <img style="width: 50px; height: 50px;"
                                    src="{{ asset('imagenes/producto/ingrediente.png') }}">
                            </div>
                            <div>
                                <p style="margin: 5px 0px; color: #12866f;"><strong>Ingrediente Activo</strong> </p>
                                <p>{!! html_entity_decode($producto->ingredientes) !!}</p>
                            </div>
                        </div>
                    @endif
                    <!--Botones-->
                    @php
                        $saludo = 'Quiero información de este producto';
                        $numeroCelular = config('services.wsp.numero');
                        $urlProducto = route('producto.index', $producto);
                        $saltoLinea = '%0D%0A';
                        $textoMensaje = "$saludo:  $saltoLinea $saltoLinea -$producto->nombre a S/. $producto->precio
                        $saltoLinea $saltoLinea $urlProducto
                        ";
                        $wspLink = "https://api.whatsapp.com/send/?phone=$numeroCelular&text=$textoMensaje&app_absent=0";
                    @endphp
                    <div>
                        @if ($producto->fichas->count())
                            <button class="producto_boton_pdf">
                                <a href="{{ Storage::url($producto->fichas->first()->ficha_ruta) }}" target="_blank">
                                    <i class="fa-solid fa-file"></i>
                                    Ficha técnica
                                </a>
                            </button>
                        @endif

                        @if ($producto->hojas->count())
                            <button class="producto_boton_pdf">
                                <a href="{{ Storage::url($producto->hojas->first()->hoja_ruta) }}" target="_blank">
                                    <i class="fa-solid fa-file-lines"></i>
                                    Hoja de Seguridad
                                </a>
                            </button>
                        @endif

                        <button class="producto_boton_wsp">
                            <a href="{{ $wspLink }}" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                                Whatsapp
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
