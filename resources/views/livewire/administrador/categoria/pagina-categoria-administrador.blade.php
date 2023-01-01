<div>
    @section('tituloPagina', 'Administrador | Categorias')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR NUEVA CATEGORIA</h2>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <form wire:submit.prevent="crearCategoria" enctype="multipart/form-data" class="formulario">
            <!--Dos input-->
            <div class="contenedor_2_elementos">
                <!--Nombre-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Nombre: </p>
                    <input type="text" wire:model="crearFormulario.nombre">
                    @error('crearFormulario.nombre')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
                <!--Ruta-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Slug: </p>
                    <input type="text" wire:model="crearFormulario.slug">
                    @error('crearFormulario.slug')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Marcas-->
            <div class="contenedor_1_elementos_100">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Marcas: </p>
                    @if ($marcas->count())
                        <div>
                            @foreach ($marcas as $marca)
                                <!--<div>-->
                                <label>
                                    <input type="checkbox" name="marcas[]" wire:model.defer="crearFormulario.marcas"
                                        value="{{ $marca->id }}">
                                    <span> {{ $marca->nombre }}</span>
                                </label>
                                <!--</div>-->
                            @endforeach
                        </div>
                        @error('crearFormulario.marcas')
                            <span>{{ $message }}</span>
                        @enderror
                    @else
                        <div class="contenedor_no_existe_elementos">
                            <p>No hay marcas</p>
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                    @endif

                </label>
            </div>
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Crear Categoria">
            </div>
        </form>
    </div>
    <!--Cotenedor tabla-->
    <h2 class="contenedor_paginas_titulo">CATEGORIAS</h2>
    @if ($categorias->count())
        <div class="py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nombre</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Ruta</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                
                                    {{ $categoria->nombre }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $categoria->slug }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                    <a href="{{ route('administrador.subcategoria', $categoria) }}">
                                        <span><i class="fa-solid fa-eye" style="color: #009eff;"></i></span>
                                        Ver
                                    </a>
                                    |
                                    <a wire:click="editarCategoria('{{ $categoria->slug }}')">
                                        <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                        Editar</a> |
                                    <a wire:click="$emit('eliminarCategoriaModal', '{{ $categoria->slug }}')">
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
            <p>No hay categorias</p>
            <i class="fa-solid fa-spinner"></i>
        </div>
    @endif

    <!--Modal editar categoria -->
    <x-jet-dialog-modal wire:model="editarFormulario.abierto">
        <!--Titulo Modal-->
        <x-slot name="title">
            <div class="contenedor_titulo_modal">
                <div>
                    <h2 style="font-weight: bold">Editar categoría</h2>
                </div>
                <div>
                    <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                        <i style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        </x-slot>
        <!--Contenido Modal-->
        <x-slot name="content">
            <div class="formulario">
                <!--Nombre-->
                <div class="contenedor_1_elementos_100">
                    <label class="label_principal">
                        <p class="estilo_nombre_input">Nombre: </p>
                        <input type="text" wire:model="editarFormulario.nombre">
                        @error('editarFormulario.nombre')
                            <span>{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <!--Ruta-->
                <div class="contenedor_1_elementos_100">
                    <label class="label_principal">
                        <p class="estilo_nombre_input">Slug: </p>
                        <input type="text" wire:model="editarFormulario.slug">
                        @error('editarFormulario.slug')
                            <span>{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <!--Marcas-->
                <div class="contenedor_1_elementos_100">
                    <label class="label_principal">
                        <p class="estilo_nombre_input">Marcas: </p>
                        <div>
                            @foreach ($marcas as $marca)
                                <label>
                                    <input type="checkbox" name="marcas[]" wire:model.defer="editarFormulario.marcas"
                                        value="{{ $marca->id }}">
                                    {{ $marca->nombre }}
                                </label>
                            @endforeach
                        </div>
                        @error('editarFormulario.marcas')
                            <span>{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="contenedor_pie_modal">
                <button style="background-color: #009eff;" wire:click="$set('editarFormulario.abierto', false)"
                    wire:loading.attr="disabled" type="submit">Cancelar</button>

                <button style="background-color: #ffa03d;" wire:click="actualizarCategoria"
                    wire:loading.attr="disabled" wire:target="editarImagen, actualizarCategoria"
                    type="submit">Editar</button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('script')
    <script>
        Livewire.on('eliminarCategoriaModal', categoriaRuta => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta categoria.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.categoria.pagina-categoria-administrador',
                        'eliminarCategoria', categoriaRuta);
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    );
                }
            })
        });
    </script>
@endpush
