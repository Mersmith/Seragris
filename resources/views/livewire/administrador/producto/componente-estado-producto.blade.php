<div class="formulario">
    <!--<form wire:submit.prevent="actualizarEstadoProducto">-->
    <!--Estado-->
    <div class="contenedor_1_elementos">
        <label class="label_principal">
            <p class="estilo_nombre_input">Estado del producto: </p>
            <div>
                <label>
                    <input type="radio" value="1" name="estado" wire:model.defer="estado">
                    Borrador
                </label>
                <label>
                    <input type="radio" value="2" name="estado" wire:model.defer="estado">
                    Publicado
                </label>
            </div>
            @error('estado')
                <span>{{ $message }}</span>
            @enderror
        </label>
    </div>
    <!--Enviar-->
    <div class="contenedor_1_elementos">
        <!--<input type="submit" value="Actualizar estado">-->
        <button wire:click="actualizarEstadoProducto" wire:loading.attr="disabled"
            wire:target="actualizarEstadoProducto">
            Actualizar estado
        </button>
    </div>
</div>
