<div>
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">GENERAR NUEVA URL</h2>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <!--Formulario-->
        <form wire:submit.prevent="procesarUrl" class="formulario">
            <!--Nombre-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">URL: </p>
                    <input type="text" wire:model="url">
                    @error('url')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Generar URL">
            </div>
        </form>
        <!--Cotenedor tabla-->
        <h2 class="contenedor_paginas_titulo">LINKS</h2>

        @if ($links->count())
            <div class="py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Titulo</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    URL</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Corto</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Visitas</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Creación</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $linkItem)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $linkItem->titulo }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $linkItem->url }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ route('administrador.shortlink.mostrar', $linkItem->slug) }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $linkItem->visits->count() }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $linkItem->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                        <a href="{{ route('administrador.shortlink.mostrar', $linkItem->slug) }}">
                                            <span><i class="fa-solid fa-eye" style="color: #009eff;"></i></span>
                                            Ver
                                        </a>
                                        |
                                        <a wire:click="editarUrl('{{ $linkItem->id }}')"><span><i
                                                    class="fa-solid fa-pencil"
                                                    style="color: green;"></i></span>Editar</a> |
                                        <a wire:click="$emit('eliminarUrlModal', '{{ $linkItem->id }}')">
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
                <p>No hay url</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>
</div>
