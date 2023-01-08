<?php

namespace App\Http\Livewire\Administrador\ShortLink;

use App\Models\ShortLink;
use Livewire\Component;

class ShortLinkMostrar extends Component
{
    public $shortlink;

    public function mount(ShortLink $shortlink)
    {
        $this->shortlink = $shortlink;
    }
    public function render()
    {
        return view('livewire.administrador.short-link.short-link-mostrar')->layout('layouts.administrador.administrador');
    }
}
