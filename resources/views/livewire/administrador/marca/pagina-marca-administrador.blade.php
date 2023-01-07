<div>
    @section('tituloPagina', 'Administrador | Marcas')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR NUEVA MARCA</h2>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <!--Formulario-->
        <form wire:submit.prevent="crearMarca" class="formulario">
            <!--Nombre-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Nombre: </p>
                    <input type="text" wire:model="crearFormulario.nombre" id="crearFormulario.nombre">
                    @error('crearFormulario.nombre')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Imagen-->
            <div class="contenedor_1_elementos_imagen">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Imagen: </p>
                    <div class="contenedor_subir_imagen_sola" style="width: 100px; height: 100px;">
                        @if ($crearFormulario['imagen_ruta'])
                            <img style="width: 100px; height: 100px;"
                                src="{{ $crearFormulario['imagen_ruta']->temporaryUrl() }}">
                        @else
                            <img style="width: 100px; height: 100px;"
                                src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                        @endif
                        <div class="opcion_cambiar_imagen">
                            Editar <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" wire:model="crearFormulario.imagen_ruta" style="display: none">
                    @error('crearFormulario.imagen_ruta')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Crear Marca">
            </div>
        </form>
        <!--Cotenedor tabla-->
        <h2 class="contenedor_paginas_titulo">MARCAS</h2>
        @if ($marcas->count())
            <div class="py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Imagen</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcas as $marca)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex-shrink-0 w-10 h-10 handle cursor-grab"
                                            style="display: flex; align-items: center;">
                                            <img class="w-full h-full "
                                                src="{{ Storage::url($marca->imagen->imagen_ruta) }}" alt="" />
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $marca->nombre }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                        <a wire:click="editarMarca('{{ $marca->id }}')"><span><i
                                                    class="fa-solid fa-pencil"
                                                    style="color: green;"></i></span>Editar</a> |
                                        <a wire:click="$emit('eliminarMarcaModal', '{{ $marca->id }}')">
                                            <span><i class="fa-solid fa-trash"
                                                    style="color: red;"></i></span>Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay marcas</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif
    </div>

    @if ($marca)
        <!--Modal editar -->
        <x-jet-dialog-modal wire:model="editarFormulario.abierto">
            <!--Titulo Modal-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <div>
                        <h2 style="font-weight: bold">Editar marca</h2>
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
                    <!--Imagen-->
                    <div class="contenedor_1_elementos_imagen">
                        <label class="label_principal">
                            <p class="estilo_nombre_input">Imagen: </p>
                            <div class="contenedor_subir_imagen_sola">
                                @if ($editarImagen)
                                    <img style="width: 100px; height: 100px;" src="{{ $editarImagen->temporaryUrl() }}"
                                        alt="">
                                @else
                                    <img style="width: 100px; height: 100px;"
                                        src="{{ Storage::url($marca->imagen->imagen_ruta) }}  ">
                                @endif
                                <div class="opcion_cambiar_imagen">
                                    Editar <i class="fa-solid fa-camera"></i>
                                </div>
                            </div>
                            <input type="file" wire:model="editarImagen" id="editarImagen" style="display: none">
                            @error('editarImagen')
                                <span>{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
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
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="contenedor_pie_modal">
                    <button style="background-color: #009eff;" wire:click="$set('editarFormulario.abierto', false)"
                        wire:loading.attr="disabled" type="submit">Cancelar</button>

                    <button style="background-color: #ffa03d;" wire:click="actualizarMarca" wire:loading.attr="disabled"
                        wire:target="actualizarMarca" type="submit">Editar</button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>

@push('script')
    <script>
        Livewire.on('eliminarMarcaModal', marcaId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta marca.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.marca.pagina-marca-administrador',
                        'eliminarMarca', marcaId);
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
