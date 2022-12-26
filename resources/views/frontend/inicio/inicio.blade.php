<x-frontend-layout>
    @section('tituloPagina', 'Inicio')
    @include('frontend.inicio.slider-principal')

    @livewire('frontend.productos.slider-producto')

</x-frontend-layout>
