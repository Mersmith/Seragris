<?php

namespace App\Http\Livewire\Administrador\CategoriaBlog;

use App\Models\CategoriaBlog;
use Livewire\Component;
use Illuminate\Support\Str;

class PaginaCategoriaBlog extends Component
{
    public $categorias, $categoria;

    protected $listeners = ['eliminarCategoria'];

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

    public function traerCategorias()
    {
        $this->categorias = CategoriaBlog::all();
    }

    public function mount()
    {
        $this->traerCategorias();
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

    public function crearCategoria()
    {
        //Método para validar las propiedades de un componente usando esas reglas.
        $this->validate();

        CategoriaBlog::create([
            'nombre' => $this->crearFormulario['nombre'],
            'slug' => $this->crearFormulario['slug'],
        ]);

        $this->traerCategorias();

        //Emitir eventos a los padres y no a los componentes secundarios o hermanos.
        $this->emit('mensajeCreado', "Categoria agregado.");
        $this->reset('crearFormulario');
    }

    public function editarCategoria(CategoriaBlog $categoria)
    {
        //Reinicia el valor de la variable
        //Borrar los errores de las claves
        $this->resetValidation();

        $this->categoria = $categoria;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $categoria->nombre;
        $this->editarFormulario['slug'] = $categoria->slug;
    }

    public function actualizarCategoria()
    {
        $rules = [
            'editarFormulario.nombre' => 'required',
            'editarFormulario.slug' => 'required|unique:categorias,slug,' . $this->categoria->id,
        ];

        $this->validate($rules);

        $this->categoria->update($this->editarFormulario);

        $this->reset(['editarFormulario']);

        $this->traerCategorias();

        $this->emit('mensajeActualizado', "La categoria ha sido actualizada.");
    }
      
    public function eliminarCategoria(CategoriaBlog $categoria)
    {
        $categoria->delete();
        $this->traerCategorias();
    }

    public function render()
    {
        return view('livewire.administrador.categoria-blog.pagina-categoria-blog')->layout('layouts.administrador.administrador');
    }
}
