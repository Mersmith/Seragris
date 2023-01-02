<x-frontend-layout>
    @section('tituloPagina', 'Inicio')
    @if ($sliders->count())
        @include('frontend.inicio.slider-principal')
    @endif

    @livewire('frontend.productos.slider-producto')

</x-frontend-layout>
