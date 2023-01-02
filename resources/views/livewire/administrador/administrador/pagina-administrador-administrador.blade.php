<div>
    @section('tituloPagina', 'Administradores')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">TODOS LOS ADMINISTRADORES</h2>
    <!--Boton crear-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.administrador.crear') }}">Crear Nuevo Administrador</a>
    </div>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        @if ($administradores->count())
            <!--Buscador-->
            <div class="contenedor_buscador">
                <input wire:model='buscar' type="text" placeholder="Busca un administrador">
            </div>
            <div class="py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    N°</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Correo</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Celular</th>

                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($administradores as $key => $administrador)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $key + 1 }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $administrador->nombre }} {{ $administrador->apellido }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $administrador->correo }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $administrador->celular }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                        <a wire:click="editarAdministrador('{{ $administrador->id }}')">
                                            <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                            Editar
                                        </a>
                                        |
                                        <a
                                            wire:click="$emit('eliminarAdministradorModal', '{{ $administrador->user_id }}')"><i
                                                class="fa-solid fa-trash" style="color: red;"></i></span>
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--Contenedor Paginacion-->
                    <div>
                        {{ $administradores->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay administradores</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif
    </div>

    @if ($administrador)
        <!--Modal editar -->
        <x-jet-dialog-modal wire:model="editarFormulario.abierto">
            <!--Titulo Modal-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <div>
                        <h2 style="font-weight: bold">Editar administrador</h2>
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
                    <!--Apellido-->
                    <div class="contenedor_1_elementos_100">
                        <label class="label_principal">
                            <p class="estilo_nombre_input">Apellido: </p>
                            <input type="text" wire:model="editarFormulario.apellido">
                            @error('editarFormulario.apellido')
                                <span>{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    <!--Celular-->
                    <div class="contenedor_1_elementos_100">
                        <label class="label_principal">
                            <p class="estilo_nombre_input">Celular: </p>
                            <input type="text" wire:model="editarFormulario.celular">
                            @error('editarFormulario.celular')
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

                    <button style="background-color: #ffa03d;" wire:click="actualizarAdministrador" wire:loading.attr="disabled"
                        wire:target="actualizarAdministrador" type="submit">Editar</button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>

@push('script')
    <script>
        Livewire.on('eliminarAdministradorModal', idAdministrador => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta administrador.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.administrador.pagina-administrador-administrador',
                        'eliminarAdmnistrador', idAdministrador);
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
