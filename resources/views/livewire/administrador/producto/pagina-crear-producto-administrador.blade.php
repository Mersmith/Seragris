<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Producto | Crear')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR NUEVO PRODUCTO</h2>
    <!--Boton regresar-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.producto.index') }}">
            <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
    </div>
    <!--Contenedor Página-->
    <div class="contenedor_paginas_administrador">
        <form wire:submit.prevent="crearProducto" x-data class="formulario">
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
            <!--Dos input-->
            <div class="contenedor_2_elementos">
                <!--Categorias-->
                <label class="label_principal">
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
                <!--Subcategorias-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Subcategorias: </p>
                    <select wire:model="subcategoria_id">
                        <option value="" selected disabled>Seleccione una subcategoría</option>

                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('subcategoria_id')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Dos input-->
            <div class="contenedor_1_elementos_100">
                <!--Marcas-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Marca:</p>
                    <select wire:model="marca_id">
                        <option value="" selected disabled>Seleccione una marca</option>

                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    @error('marca_id')
                        <span>{{ $message }}</span>
                    @enderror
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
            <!--Dos input-->
            <div class="contenedor_2_elementos">
                <!--Precio Real-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Precio real:</p>
                    <input type="number" wire:model="precio_real" step="0.01">
                    @error('precio_real')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
                <!--Precio Oferta-->
                <label class="label_principal">
                    <p class="estilo_nombre_input">Precio oferta:</p>
                    <input type="number" wire:model="precio">
                    @if ($precio)
                        @if ($precio == $precio_real)
                            <code>No tiene descuento.</code>
                        @elseif($precio_real > $precio)
                            <code>Tiene un descuento de: %{{ 100 - (100 * $precio) / $precio_real }}</code>
                        @else
                            <code>El precio de Oferta tiene que ser menor al precio Real.</code>
                        @endif
                    @endif
                    @error('precio')
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
            <!--Informacion-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Información: </p>
                    <textarea rows="3" wire:model="informacion" x-data x-init="ClassicEditor.create($refs.miEditor, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList']
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('informacion', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor">
                    </textarea>
                </label>
            </div>
            @error('informacion')
                <span>{{ $message }}</span>
            @enderror
            <!--controla-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Controla: </p>
                    <textarea rows="3" wire:model="controla" x-data x-init="ClassicEditor.create($refs.miEditor2, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList']
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('controla', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor2">
                    </textarea>
                </label>
            </div>
            @error('controla')
                <span>{{ $message }}</span>
            @enderror
            <!--cultivos-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Cultivos en los que se usa: </p>
                    <textarea rows="3" wire:model="cultivos" x-data x-init="ClassicEditor.create($refs.miEditor3, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList']
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('cultivos', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor3">
                    </textarea>
                </label>
            </div>
            @error('cultivos')
                <span>{{ $message }}</span>
            @enderror
            <!--ingredientes-->
            <div class="contenedor_1_elementos_100" wire:ignore>
                <label class="label_principal">
                    <p class="estilo_nombre_input">Ingrediente Activo: </p>
                    <textarea rows="3" wire:model="ingredientes" x-data x-init="ClassicEditor.create($refs.miEditor4, {
                            toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList']
                        })
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('ingredientes', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="miEditor4">
                    </textarea>
                </label>
            </div>
            @error('ingredientes')
                <span>{{ $message }}</span>
            @enderror

            <!--Ficha-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Ficha: </p>
                    <div class="contenedor_subir_imagen_sola"
                        style="width: 100px; display: flex; flex-direction:column; justify-content: center;">
                        @if ($ficha)
                            <img src="{{ asset('imagenes/pdf/con_foto_pdf.png') }}">
                        @else
                            <img src="{{ asset('imagenes/pdf/sin_foto_pdf.png') }}">
                        @endif
                        <div class="opcion_cambiar_imagen">
                            Editar <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                    <input type="file" wire:model="ficha" style="display: none">
                    @error('ficha')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            @if ($ficha)
                <p style="cursor: pointer;" wire:click="$set('ficha', null)">Borrar <i class="fa-solid fa-trash"></i>
                </p>
            @endif
            <!--Hoja-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Hoja: </p>
                    <div class="contenedor_subir_imagen_sola"
                        style="width: 100px; height: 100px; display: flex; justify-content: center;">
                        @if ($hoja)
                            <img src="{{ asset('imagenes/pdf/con_foto_pdf.png') }}">
                        @else
                            <img src="{{ asset('imagenes/pdf/sin_foto_pdf.png') }}">
                        @endif
                        <div class="opcion_cambiar_imagen">
                            Editar <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                    <input type="file" wire:model="hoja" style="display: none">
                    @error('hoja')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            @if ($hoja)
                <p style="cursor: pointer;" wire:click="$set('hoja', null)">Borrar <i class="fa-solid fa-trash"></i>
                </p>
            @endif
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Crear Producto">
            </div>
        </form>
    </div>
</div>
