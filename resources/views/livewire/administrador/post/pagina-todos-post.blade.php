<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Blog | Post')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">TODOS LOS POSTS</h2>
    <!--Boton crear-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.post.crear') }}">Crear Nuevo Post</a>
    </div>
    <!--Contenedor tabla-->
    @if ($posts->count())
        <!--Buscador-->
        <div class="contenedor_buscador">
            <input type="text" wire:model="buscarPost" placeholder="Ingrese el nombre del post que quiere buscar.">
        </div>
        <div class="py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Imagen</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nombre</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Ruta</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Categoría</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Estado</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        @if ($post->imagen->count())
                                            <img class="w-full h-full"
                                                src="{{ Storage::url($post->imagen->imagen_ruta) }}" alt="" />
                                        @else
                                            <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $post->nombre }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $post->slug }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $post->categoria_blog->nombre }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @switch($post->estado)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                    <a href="{{ route('administrador.post.editar', $post) }}">
                                        <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                        Editar</a> |
                                    <a wire:click="$emit('eliminarPostModal', '{{ $post->slug }}')">
                                        <span><i class="fa-solid fa-trash" style="color: red;"></i></span>
                                        Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="contenedor_no_existe_elementos">
            <p>No hay productos</p>
            <i class="fa-solid fa-spinner"></i>
        </div>
    @endif
    @if ($posts->hasPages())
        <div class="px-6 py-4">
            {{ $posts->links() }}
        </div>
    @endif
</div>

@push('script')
    <script>
        Livewire.on('eliminarPostModal', postId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar este post.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.post.pagina-todos-post',
                        'eliminarPost', postId);
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    );
                }
            })
        })
    </script>
@endpush
