<?php

namespace App\Http\Livewire\Administrador\ShortLink;

use App\Models\ShortLink;
use Livewire\Component;
use Illuminate\Support\Str;

class ShortLinkInicio extends Component
{
    public $url;
    public $links;

    public function traerLinks()
    {
        $this->links = ShortLink::all();
    }

    public function mount()
    {
        $this->traerLinks();
    }

    public function procesarUrl()
    {
        //Expresion regular url valida http|https opcional
        $this->validate([
            'url' => ['required', 'regex:/^(http|https)?(:\/\/)?(www\.)?[a-zA-Z0-9]+([\-\.]{1}[a-zA-Z0-9]+)*\.[a-zA-Z]{2,5}(:[0-9]{1,5})?(\/.*)?$/']
        ]);

        if (!preg_match("~^(?:f|ht)tps?://~i", $this->url)) {
            $this->url = "http://" . $this->url;
        }

        $title = file_get_contents($this->url);
        preg_match('/<title>(.*)<\/title>/', $title, $matches);
        $title = $matches[1];

        ShortLink::create([
            'url' => $this->url,
            'titulo' => $title,
            'slug' => Str::random(8),
        ]);

        $this->traerLinks();

        $this->reset('url');
        $this->emit('mensajeActualizado', "Url generado.");
    }

    public function render()
    {
        return view('livewire.administrador.short-link.short-link-inicio')->layout('layouts.administrador.administrador');
    }
}
