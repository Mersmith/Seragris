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
                                        {{ $administrador->nombre }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $administrador->correo }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                        <a
                                            href="">
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
                <p>No hay permisos</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif
    </div>
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
