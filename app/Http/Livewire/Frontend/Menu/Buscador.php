<?php

namespace App\Http\Livewire\Frontend\Menu;

use App\Models\Producto;
use Livewire\Component;

class Buscador extends Component
{
    public $buscar;

    public $abierto = false;

    public function updatedBuscar($value)
    {
        if ($value) {
            $this->abierto = true;
        } else {
            $this->abierto = false;
        }
    }

    public function render()
    {
        if ($this->buscar) {
            $productosBuscador = Producto::where('nombre', 'LIKE', '%' . $this->buscar . '%')
                ->where('estado', 2)
                ->take(8)
                ->get();
        } else {
            $productosBuscador = [];
        }

        return view('livewire.frontend.menu.buscador', compact('productosBuscador'));
    }
}
