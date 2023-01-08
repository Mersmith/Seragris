<x-frontend-layout>
    <!--SEO-->
    @section('tituloPagina', 'Inicio')
    @section('descripcion',
        'SERAGRIS es una empresa peruana dedicada a la comercialización de insumos agrícolas y
        Cultivo de arroz.')
    @section('url', '' . url()->current())
    @section('imagen', '' . asset('imagenes/empresa/logo.png'))
    
    <!--CONTENIDO PÁGINA-->
    @if ($sliders->count())
        @include('frontend.inicio.slider-principal')
    @endif

    @livewire('frontend.productos.slider-producto')

</x-frontend-layout>
