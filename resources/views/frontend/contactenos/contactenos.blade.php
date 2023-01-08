<x-frontend-layout>
    <!--SEO-->
    @section('tituloPagina', 'Contactenos')
    @section('descripcion', 'Contactate con Seragris.')
    @section('url', '' . url()->current())
    @section('imagen', '' . asset('imagenes/empresa/logo.png'))

    <!--CONTENIDO PÁGINA-->
    @include('frontend.contactenos.banner')
    @include('frontend.contactenos.descripcion')
    @include('frontend.contactenos.mapa-telefonos')
    
</x-frontend-layout>
