<?php

namespace App\Http\Livewire\Administrador\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class PaginaTag extends Component
{
    public $tags, $tag;

    protected $listeners = ['eliminarTag'];

    public $crearFormulario = [
        'nombre' => null,
        'slug' => null,
    ];

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
        'slug' => null,
    ];

    //propiedad para establecer reglas de validación por componente
    protected $rules = [
        'crearFormulario.nombre' => 'required',
        'crearFormulario.slug' => 'required|unique:categorias,slug',
    ];

    //personalizar los mensajes de validación utilizados por un componente de Livewire
    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre de categoria',
        'crearFormulario.slug' => 'slug de categoria',

        'editarFormulario.nombre' => 'nombre de categoria',
        'editarFormulario.slug' => 'slug de categoria',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.slug.required' => 'El :attribute  requerido.',

        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.slug.required' => 'El :attribute es requerido.',
    ];

    public function traerTags()
    {
        $this->tags = Tag::all();
    }

    public function mount()
    {
        $this->traerTags();
    }

    //Detecta un cambio o una actualización en un campo
    public function updatedCrearFormularioNombre($value)
    {
        $this->crearFormulario['slug'] = Str::slug($value);
    }

    public function updatedEditarFormularioNombre($value)
    {
        $this->editarFormulario['slug'] = Str::slug($value);
    }

    public function crearTag()
    {
        //Método para validar las propiedades de un componente usando esas reglas.
        $this->validate();

        Tag::create([
            'nombre' => $this->crearFormulario['nombre'],
            'slug' => $this->crearFormulario['slug'],
        ]);

        $this->traerTags();

        //Emitir eventos a los padres y no a los componentes secundarios o hermanos.
        $this->emit('mensajeCreado', "Tag agregado.");
        $this->reset('crearFormulario');
    }

    public function editarTag(Tag $tag)
    {
        //Reinicia el valor de la variable
        //Borrar los errores de las claves
        $this->resetValidation();

        $this->tag = $tag;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $tag->nombre;
        $this->editarFormulario['slug'] = $tag->slug;
    }

    public function actualizarTag()
    {
        $rules = [
            'editarFormulario.nombre' => 'required',
            'editarFormulario.slug' => 'required|unique:categorias,slug,' . $this->tag->id,
        ];

        $this->validate($rules);

        $this->tag->update($this->editarFormulario);

        $this->reset(['editarFormulario']);

        $this->traerTags();

        $this->emit('mensajeActualizado', "El tag ha sido actualizada.");
    }

    public function eliminarTag(Tag $tag)
    {
        $tag->delete();
        $this->traerTags();
    }

    public function render()
    {
        return view('livewire.administrador.tag.pagina-tag')->layout('layouts.administrador.administrador');
    }
}
