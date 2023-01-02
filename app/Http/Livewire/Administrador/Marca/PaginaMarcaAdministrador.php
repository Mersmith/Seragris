<?php

namespace App\Http\Livewire\Administrador\Marca;

use Livewire\Component;
use App\Models\Marca;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PaginaMarcaAdministrador extends Component
{

    public $marcas, $marca;

    protected $listeners = ['eliminarMarca'];

    public $crearFormulario = [
        'nombre' => null,
    ];

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
    ];

    public $rules = [
        'crearFormulario.nombre' => 'required',
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre de la marca',
        'editarFormulario.nombre' => 'nombre de la marca',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
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

        Marca::create([
            'nombre' => $this->crearFormulario['nombre']
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
    }

    public function actualizarMarca()
    {
        $this->validate([
            'editarFormulario.nombre' => 'required'
        ]);

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
        $marca->delete();
        $this->traerMarcas();
    }
    
    public function render()
    {
        return view('livewire.administrador.marca.pagina-marca-administrador')->layout('layouts.administrador.administrador');
    }
}
