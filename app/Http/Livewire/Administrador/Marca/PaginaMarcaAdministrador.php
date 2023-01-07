<?php

namespace App\Http\Livewire\Administrador\Marca;

use Livewire\Component;
use App\Models\Marca;
use App\Models\Imagen;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PaginaMarcaAdministrador extends Component
{
    use WithFileUploads;

    public $marcas, $marca;
    public $editarImagen;

    protected $listeners = ['eliminarMarca'];

    public $crearFormulario = [
        'nombre' => null,
        'imagen_ruta' => null,
    ];

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
        'imagen_ruta' => null,
    ];

    public $rules = [
        'crearFormulario.nombre' => 'required',
        'crearFormulario.imagen_ruta' => 'required|image|max:1024',
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre de la marca',
        'editarFormulario.nombre' => 'nombre de la marca',
        'crearFormulario.imagen_ruta' => 'imagen de la marca',
        'editarFormulario.imagen_ruta' => 'imagen de la marca'
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.imagen_ruta.required' => 'El :attribute es requerido.',
        'editarFormulario.imagen_ruta.required' => 'El :attribute es requerido.',
    ];

    public function mount()
    {
        $this->traerMarcas();
    }

    public function traerMarcas()
    {
        $this->marcas = Marca::all();
    }

    public function crearMarca()
    {
        $this->validate();

        $imagen = $this->crearFormulario['imagen_ruta']->store('marcas');

        $marcaNuevo = Marca::create([
            'nombre' => $this->crearFormulario['nombre']
        ]);

        $marcaNuevo->imagen()->create([
            'imagen_ruta' => $imagen
        ]);

        $this->traerMarcas();

        $this->emit('mensajeCreado', "Marca creada.");
        $this->reset('crearFormulario');
    }
    public function editarMarca(Marca $marca)
    {
        $this->marca = $marca;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $marca->nombre;
        $this->editarFormulario['imagen_ruta'] = $marca->imagen->imagen_ruta;
    }

    public function actualizarMarca()
    {
        $this->validate([
            'editarFormulario.nombre' => 'required'
        ]);

        if ($this->editarImagen) {
            $rules['editarImagen'] = 'required|image|max:1024';
        }

        if ($this->editarImagen) {
            Storage::delete([$this->marca->imagen->imagen_ruta]);

            $imagenBusqueda = Imagen::find($this->marca->imagen->id);
            $imagenBusqueda->delete();

            $imagenNueva = $this->editarImagen->store('marcas');

            $this->marca->imagen()->create([
                'imagen_ruta' => $imagenNueva
            ]);
        }

        $this->marca->update(
            [
                'nombre' => $this->editarFormulario['nombre'],
            ]
        );

        $this->traerMarcas();
        $this->reset('editarFormulario');
        $this->emit('mensajeActualizado', "Marca actualizada.");
    }

    public function eliminarMarca(Marca $marca)
    {
        if ($marca->imagen->imagen_ruta) {
            Storage::delete([$marca->imagen->imagen_ruta]);
            $imagenBusqueda = Imagen::find($marca->imagen->id);
            $imagenBusqueda->delete();
        }

        $marca->delete();
        
        $this->traerMarcas();
    }

    public function render()
    {
        return view('livewire.administrador.marca.pagina-marca-administrador')->layout('layouts.administrador.administrador');
    }
}
