<?php

namespace App\Http\Livewire\Administrador\Administrador;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        'editarFormulario.contrasena.min' => 'La :attribute necesita mínimo 9 letras.',
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

        $rules = [
            'editarFormulario.nombre' => 'required',
            'editarFormulario.apellido' => 'required',
            'editarFormulario.celular' => 'required',
        ];

        if ($this->editarFormulario['contrasena']) {
            $rules['editarFormulario.contrasena'] = 'required|min:9';
        }

        $this->validate($rules);

        $this->administrador->update(
            [
                'nombre' => $this->editarFormulario['nombre'],
                'apellido' => $this->editarFormulario['apellido'],
                'celular' => $this->editarFormulario['celular'],
            ]
        );

        if ($this->editarFormulario['contrasena']) {
            $usuario = User::find($this->administrador->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editarFormulario['contrasena'];

            $usuario->password = Hash::make($contrasenaNueva);
            $usuario->save();
        }

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
