<div>
    @section('tituloPagina', 'Administrador | Sliders')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR NUEVO SLIDER</h2>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <form wire:submit.prevent="crearSlider" enctype="multipart/form-data" class="formulario">
            <!--Nombre-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Link: </p>
                    <input type="text" wire:model="crearFormulario.link">
                    @error('crearFormulario.link')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Estado-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Estado</p>
                    <div>
                        <label>
                            <input type="radio" value="1" name="estado"
                                wire:model.defer="crearFormulario.estado">
                            Desactivado
                        </label>
                        <label>
                            <input type="radio" value="0" name="estado"
                                wire:model.defer="crearFormulario.estado">
                            Activado
                        </label>
                    </div>
                    @error('crearFormulario.estado')
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
                <input type="submit" value="Crear Slider">
            </div>
        </form>
    </div>
    <!--Sliders-->
    <h2 class="contenedor_paginas_titulo">SLIDERS</h2>
    @if ($sliders->count())

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
                                Link</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Estado</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Acción</th>
                        </tr>
                    </thead>
                    <tbody id="sortablesliders">
                        @foreach ($sliders as $sliderItem)
                            <tr data-id="{{ $sliderItem->id }}">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex-shrink-0 w-10 h-10 handle cursor-grab"
                                        style="display: flex; align-items: center; cursor: pointer;">
                                        <i class="fa-solid fa-arrows-up-down-left-right"
                                            style="margin-right: 8px; color: rgb(30, 152, 233);"></i>
                                        <img class="w-full h-full "
                                            src="{{ Storage::url($sliderItem->imagenes->first()->imagen_ruta) }}"
                                            alt="" />
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $sliderItem->link }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @switch($sliderItem->estado)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Oculto
                                            </span>
                                        @break

                                        @case(0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Visible
                                            </span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                    <a wire:click="editarSlider('{{ $sliderItem->id }}')">
                                        <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                        Editar</a> |
                                    <a wire:click="$emit('eliminarSliderModal', '{{ $sliderItem->id }}')">
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
            <p>No hay sliders</p>
            <i class="fa-solid fa-spinner"></i>
        </div>
    @endif

    <!--Modal-->
    @if ($editarFormulario['abierto'])
        <x-jet-dialog-modal wire:model="editarFormulario.abierto">
            <!--Titulo Modal-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <div>
                        <h2 style="font-weight: bold">Editar slider</h2>
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
                                        src="{{ Storage::url($slider->imagenes->first()->imagen_ruta) }}  ">
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
                            <p class="estilo_nombre_input">Link: </p>
                            <input type="text" wire:model="editarFormulario.link">
                            @error('editarFormulario.link')
                                <span>{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    <!--Estado-->
                    <div class="contenedor_1_elementos_100">
                        <label class="label_principal">
                            <p class="estilo_nombre_input">Estado</p>
                            <div>
                                <label>
                                    <input type="radio" value="1" name="estado"
                                        wire:model.defer="editarFormulario.estado">
                                    Desactivado
                                </label>
                                <label>
                                    <input type="radio" value="0" name="estado"
                                        wire:model.defer="editarFormulario.estado">
                                    Activado
                                </label>
                            </div>
                            @error('editarFormulario.estado')
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

                    <button style="background-color: #ffa03d;" wire:click="actualizarSlider"
                        wire:loading.attr="disabled" wire:target="editarImagen, actualizarSlider"
                        type="submit">Editar</button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>

    @endif
</div>
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        //https://sortablejs.github.io/Sortable/
        new Sortable(sortablesliders, {
            handle: '.handle',
            animation: 150,
            ghostClass: 'bg-blue-100',
            store: {
                set: function(sortable) {
                    const sorts = sortable.toArray();
                    axios.post("{{ route('api.sort.sliders') }}", {
                        sorts: sorts
                    }).catch(function(error) {
                        console.log(error);
                    });
                }
            }
        });
    </script>

    <script>
        Livewire.on('eliminarSliderModal', sliderId => {
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
                    Livewire.emitTo('administrador.slider.pagina-slider-administrador',
                        'eliminarSlider', sliderId);
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
