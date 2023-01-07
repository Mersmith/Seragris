<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Blog | Crear')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR NUEVO POST BLOG</h2>
    <!--Boton regresar-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.post.index') }}">
            <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
    </div>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <form wire:submit.prevent="crearPost" x-data class="formulario">
            <!--Estado-->
            <div class="contenedor_1_elementos">
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
            </div>
            <!--Imagenes-->
            <div class="contenedor_1_elementos_imagen">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Imagen: </p>
                    <div class="contenedor_subir_imagen_sola"
                        style="width: 100px; height: 100px; display: flex; justify-content: center;">
                        @if ($imagen)
                            <img style="height: 100px;" src="{{ $imagen->temporaryUrl() }}">
                        @else
                            <img style="width: 100px; height: 100px;"
                                src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                        @endif
                        <div class="opcion_cambiar_imagen">
                            Editar <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" wire:model="imagen" style="display: none">
                    @error('imagen')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Categorias-->
            <div class="contenedor_1_elementos_100">
                <label Categorias="label_principal">
                    <p class="estilo_nombre_input">Categorias: </p>
                    <select wire:model="categoria_id">
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
                    <input type="text" wire:model="nombre" id="nombre">
                    @error('nombre')
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
                    <textarea rows="3" wire:model="descripcion"></textarea>
                    @error('descripcion')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Cuerpo-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Información: </p>
                    <textarea rows="3" wire:model="cuerpo" x-data x-init="ClassicEditor.create($refs.miEditor, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList', 'uploadImage'],
                            simpleUpload: {
                                uploadUrl: '{{ route('administrador.ckeditor.upload') }}'
                            }
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('cuerpo', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor">
                </textarea>
                </label>
            </div>
            @error('cuerpo')
                <span>{{ $message }}</span>
            @enderror
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Crear Post">
            </div>
        </form>
    </div>
</div>
