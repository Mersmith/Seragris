<x-frontend-layout>
    @section('tituloPagina', 'Post')
    <!--CONTENEDOR-GRID-->
    <div class="contenedor_centrar_pagina">
        <div class="contenedor_grid_blog">
            <!--GRID-POST-->
            <div class="blog_grid_info">
                <div>
                    <a href=""> <span
                            style="color: #f59f14; font-weight: 600;">>{{ $post->categoria_blog->nombre }}</span>
                    </a>
                    <h1>{{ $post->nombre }}</h1>
                    <p>{{ $post->descripcion }}</p>
                </div>
                <div>
                    <img class="w-full h-80 object-cover object-center"
                        src="{{ Storage::url($post->imagen->imagen_ruta) }}" alt="">
                </div>
                <br>
                <div>{!! html_entity_decode($post->cuerpo) !!}</div>
                <br>
                <div>
                    @foreach ($post->tags as $tag)
                        <a href="" class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full"
                            style="background-color: #078169">
                            {{ $tag->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>
            <!--GRID-SIMILARES-->
            <div class="blog_grid_similares">
                <div>
                    <h2>Relacionados</h2>
                </div>
                @foreach ($similares as $similar)
                    <div class="contenedor_similares">
                        <div>
                            <img class="w-36 h-20 object-cover object-center"
                                src="{{ Storage::url($similar->imagen->imagen_ruta) }}" alt="">
                        </div>
                        <div>
                            <p>{{ $similar->nombre }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-frontend-layout>
