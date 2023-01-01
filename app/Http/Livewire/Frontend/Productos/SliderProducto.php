<?php

namespace App\Http\Livewire\Frontend\Productos;

use App\Models\Producto;
use Livewire\Component;

class SliderProducto extends Component
{
    public function render()
    {
        $productos = Producto::where('estado', 2)->orderBy('created_at', 'desc')->limit(10)->get();

        return view('livewire.frontend.productos.slider-producto', compact('productos'));
    }
}
