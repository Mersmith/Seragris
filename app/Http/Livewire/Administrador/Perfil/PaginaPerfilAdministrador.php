<?php

namespace App\Http\Livewire\Administrador\Perfil;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaginaPerfilAdministrador extends Component
{
    use WithFileUploads;

    public $nombre, $apellido, $celular, $imagen_ruta;

    public $nueva_imagen_ruta;

    public function mount()
    {
        $this->nombre = Auth::user()->administrador ? Auth::user()->administrador->nombre : "";
        $this->apellido = Auth::user()->administrador ? Auth::user()->administrador->apellido : "";
        $this->celular = Auth::user()->administrador ? Auth::user()->administrador->celular : "";
        $this->imagen_ruta = Auth::user()->administrador ? Auth::user()->administrador->imagen_ruta : "";
    }

    public function editarPerfilAdministrador()
    {

        if ($this->nueva_imagen_ruta) {
            $imagenNombre = $this->nueva_imagen_ruta->store('perfiles/administradores');

            if ($this->imagen_ruta) {
                Storage::delete($this->imagen_ruta);
            }
        }

        Auth::user()->administrador->update(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'celular' => $this->celular,
                'imagen_ruta' => $this->nueva_imagen_ruta ? $imagenNombre  : $this->imagen_ruta,
            ]
        );
    }

    public function render()
    {
        $administrador = Administrador::where('user_id', Auth::user()->id)->first();

        if (!$administrador) {
            $nuevoAdministrador = new Administrador();
            $nuevoAdministrador->user_id = Auth::user()->id;
            $nuevoAdministrador->correo = Auth::user()->email;
            $nuevoAdministrador->save();
        }

        $usuario = User::find(Auth::user()->id);

        return view('livewire.administrador.perfil.pagina-perfil-administrador', ['usuario' => $usuario])->layout('layouts.administrador.administrador');
    }
}
