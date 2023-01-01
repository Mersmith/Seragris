<?php

namespace App\Http\Livewire\Administrador\Producto;

use Livewire\Component;

class ComponenteEstadoProducto extends Component
{
    public $productoEstado, $estado;

    public function mount()
    {
        $this->estado = $this->productoEstado->estado;
    }

    public function actualizarEstadoProducto()
    {
        $this->productoEstado->estado = $this->estado;
        $this->productoEstado->save();

        $this->emit('mensajeActualizado', "Estado actualizado.");
    }

    public function render()
    {
        return view('livewire.administrador.producto.componente-estado-producto');
    }
}
