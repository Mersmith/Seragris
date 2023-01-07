<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Blog | Editar')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">EDITAR POST BLOG</h2>
    <!--Boton regresar-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.post.index') }}">
            <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        <button wire:click="$emit('eliminarPostModal')">
            Eliminar post
        </button>
        <a href="{{ route('administrador.post.crear') }}">Crear Nuevo Post</a>

    </div>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <div x-data class="formulario">
            <!--Estado-->
            {{-- <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Estado: </p>
                    <div>
                        <label>
                            <input type="radio" value="2" name="estado" wire:model.defer="estado">
                            Publicado
                        </label>
                        <label>
                            <input type="radio" value="1" name="estado" wire:model.defer="estado">
                            Borrador
                        </label>
                    </div>
                    @error('estado')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div> --}}
            <!--Imagenes-->
            <div class="contenedor_1_elementos_imagen">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Imagen: </p>
                    <div class="contenedor_subir_imagen_sola"
                        style="width: 100px; height: 100px; display: flex; justify-content: center;">
                        @if ($editar_imagen)
                            <img style="height: 100px;" src="{{ $editar_imagen->temporaryUrl() }}" alt="">
                        @else
                            <img style="height: 100px;" src="{{ Storage::url($post->imagen->imagen_ruta) }}  ">
                        @endif
                        <div class="opcion_cambiar_imagen">
                            Editar <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" wire:model="editar_imagen" id="editar_imagen" style="display: none">
                    @error('editar_imagen')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Categorias-->
            <div class="contenedor_1_elementos_100">
                <label Categorias="label_principal">
                    <p class="estilo_nombre_input">Categorias: </p>
                    <select wire:model="post.categoria_blog_id">
                        <option value="" selected disabled>Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Etiquetas-->
            <div class="contenedor_1_elementos_100">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Marcas: </p>
                    @if ($tags->count())
                        <div>
                            @foreach ($tags as $tagItem)
                                <!--<div>-->
                                <label>
                                    <input type="checkbox" wire:model.defer="tag" value="{{ $tagItem->id }}">
                                    <span> {{ $tagItem->nombre }}</span>
                                </label>
                                <!--</div>-->
                            @endforeach
                        </div>
                        @error('tag')
                            <span>{{ $message }}</span>
                        @enderror
                    @else
                        <div class="contenedor_no_existe_elementos">
                            <p>No hay tags</p>
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                    @endif

                </label>
            </div>
            <!--Dos input-->
            <div class="contenedor_2_elementos">
                <!--Nombre-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Nombre:</p>
                    <input type="text" wire:model="post.nombre" id="nombre">
                    @error('post.nombre')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
                <!--Ruta-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Slug:</p>
                    <input type="text" wire:model="slug">
                    @error('slug')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Descripcion Corta-->
            <div class="contenedor_1_elementos_100">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Descripción corta: </p>
                    <textarea rows="3" wire:model="post.descripcion"></textarea>
                    @error('post.descripcion')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Cuerpo-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Información: </p>
                    <textarea rows="3" wire:model="post.cuerpo" x-data x-init="ClassicEditor.create($refs.miEditor, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList', 'uploadImage'],
                            simpleUpload: {
                                uploadUrl: '{{ route('administrador.ckeditor.upload') }}'
                            }
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('post.cuerpo', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor">
                </textarea>
                </label>
            </div>
            @error('post.cuerpo')
                <span>{{ $message }}</span>
            @enderror
            <!--Enviar-->
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <!--<input type="submit" value="Actualizar Producto">-->
                <button wire:loading.attr="disabled" wire:target="editarPost" wire:click="editarPost">
                    Actualizar post
                </button>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            Livewire.on('eliminarPostModal', () => {
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
                        Livewire.emitTo('administrador.post.pagina-editar-post',
                            'eliminarPost');
                        Swal.fire(
                            '¡Eliminado!',
                            'Eliminaste correctamente.',
                            'success'
                        )
                    }
                })

            })
        </script>
    @endpush

</div>
