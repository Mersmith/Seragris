<?php

namespace App\Http\Livewire\Administrador\Administrador;

use App\Models\Administrador;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PaginaAdministradorAdministrador extends Component
{
    use WithPagination;
    //Los detectores de eventos
    protected $listeners = ['eliminarAdmnistrador'];

    public $buscar;
    public $administrador;

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
        'apellido' => null,
        'celular' => null,
        'contrasena' => null,
    ];

    protected $validationAttributes = [
        'editarFormulario.nombre' => 'nombre del administrador',
        'editarFormulario.apellido' => 'apellido del administrador',
        'editarFormulario.celular' => 'celular del administrador',
        'editarFormulario.contrasena' => 'contraseña del administrador',
    ];

    protected $messages = [
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.apellido.required' => 'El :attribute es requerido.',
        'editarFormulario.celular.required' => 'El :attribute es requerido.',
        'editarFormulario.contrasena.required' => 'La :attribute es requerido.',
    ];

    public function editarAdministrador(Administrador $administrador)
    {
        $this->administrador = $administrador;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $administrador->nombre;
        $this->editarFormulario['apellido'] = $administrador->apellido;
        $this->editarFormulario['celular'] = $administrador->celular;
        $this->editarFormulario['contrasena'] = $administrador->contrasena;
    }

    public function actualizarAdministrador()
    {
        $this->validate([
            'editarFormulario.nombre' => 'required',
            'editarFormulario.apellido' => 'required',
            'editarFormulario.celular' => 'required',
            //'editarFormulario.contrasena' => 'required',
        ]);

        $this->administrador->update(
            [
                'nombre' => $this->editarFormulario['nombre'],
                'apellido' => $this->editarFormulario['apellido'],
                'celular' => $this->editarFormulario['celular'],
            ]
        );

        $this->reset('editarFormulario');
        $this->emit('mensajeActualizado', "Admnistrador actualizada.");
    }


    //Actualizar la variable Buscar y resetea la paginación.
    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function eliminarAdmnistrador(User $usuario)
    {
        $usuario->delete();
    }

    public function render()
    {
        $administradores = Administrador::where('nombre', 'LIKE', '%' . $this->buscar . '%')
            ->orWhere('correo', 'LIKE', '%' . $this->buscar . '%')
            ->paginate(10);

        return view('livewire.administrador.administrador.pagina-administrador-administrador', compact('administradores'))->layout('layouts.administrador.administrador');
    }
}
