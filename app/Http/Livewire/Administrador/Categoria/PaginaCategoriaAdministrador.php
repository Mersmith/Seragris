<?php

namespace App\Http\Livewire\Administrador\Categoria;

use Livewire\Component;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Support\Str;

class PaginaCategoriaAdministrador extends Component
{
    public $marcas, $categorias, $categoria, $aleatorio;

    protected $listeners = ['eliminarCategoria'];

    public $crearFormulario = [
        'nombre' => null,
        'slug' => null,
        'marcas' => [],
    ];

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
        'slug' => null,
        'marcas' => [],
    ];

    //propiedad para establecer reglas de validación por componente
    protected $rules = [
        'crearFormulario.nombre' => 'required',
        'crearFormulario.slug' => 'required|unique:categorias,slug',
        'crearFormulario.marcas' => 'required',
    ];

    //personalizar los mensajes de validación utilizados por un componente de Livewire
    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre de categoria',
        'crearFormulario.slug' => 'slug de categoria',
        'crearFormulario.marcas' => 'marcas de categoria',

        'editarFormulario.nombre' => 'nombre de categoria',
        'editarFormulario.slug' => 'slug de categoria',
        'editarFormulario.marcas' => 'marcas de categoria',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.slug.required' => 'El :attribute  requerido.',
        'crearFormulario.marcas.required' => 'La :attribute es requerido.',

        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.slug.required' => 'El :attribute es requerido.',
        'editarFormulario.marcas.required' => 'La :attribute es requerido.',
    ];

    public function mount()
    {
        $this->traerMarcas();
        $this->traerCategorias();
        $this->aleatorio = rand();
    }

    public function traerMarcas()
    {
        $this->marcas = Marca::all();
    }

    public function traerCategorias()
    {
        $this->categorias = Categoria::all();
    }

    //Detecta un cambio o una actualización en un campo
    public function updatedCrearFormularioNombre($value)
    {
        $this->crearFormulario['slug'] = Str::slug($value);
    }

    //Detecta un cambio o una actualización en un campo
    public function updatedEditarFormularioNombre($value)
    {
        $this->editarFormulario['slug'] = Str::slug($value);
    }

    public function crearCategoria()
    {
        //Método para validar las propiedades de un componente usando esas reglas.
        $this->validate();


        $categoria = Categoria::create([
            'nombre' => $this->crearFormulario['nombre'],
            'slug' => $this->crearFormulario['slug'],
        ]);

        $categoria->marcas()->attach($this->crearFormulario['marcas']);

        $this->aleatorio = rand();

        $this->traerCategorias();

        //Emitir eventos a los padres y no a los componentes secundarios o hermanos.
        $this->emit('mensajeCreado', "Categoria agregado.");
        $this->reset('crearFormulario');
    }

    public function editarCategoria(Categoria $categoria)
    {
        //Reinicia el valor de la variable
        //Borrar los errores de las claves
        $this->resetValidation();

        $this->categoria = $categoria;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $categoria->nombre;
        $this->editarFormulario['slug'] = $categoria->slug;
        $this->editarFormulario['marcas'] = $categoria->marcas->pluck('id');
    }

    public function actualizarCategoria()
    {
        $rules = [
            'editarFormulario.nombre' => 'required',
            'editarFormulario.slug' => 'required|unique:categorias,slug,' . $this->categoria->id,
            'editarFormulario.marcas' => 'required',
        ];

        $this->validate($rules);

        $this->categoria->update($this->editarFormulario);

        $this->categoria->marcas()->sync($this->editarFormulario['marcas']);

        $this->reset(['editarFormulario']);

        $this->traerCategorias();

        $this->emit('mensajeActualizado', "La categoria ha sido actualizada.");
    }
    
    public function eliminarCategoria(Categoria $categoria)
    {
        $categoria->delete();
        $this->traerCategorias();
    }

    public function render()
    {
        return view('livewire.administrador.categoria.pagina-categoria-administrador')->layout('layouts.administrador.administrador');
    }
}
