<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Administrador\StoreAdministrador;

class AdministradorController extends Controller
{
    public function nuevo()
    {
        return view('administrador.administrador.crear');
    }
    public function crear(StoreAdministrador $request)
    {
        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 'administrador';
        $usuario->save();

        $usuario->administrador()->create(
            [
                'nombre' => $request->nombre,
                'correo' => $request->email,
                'rol' => 'administrador',
            ]
        );

        return redirect()->route('administrador.administrador.index')->with('crear', 'El Administrador se creo correctamente.');
    }

    public function editar(User $usuario)
    {
        return view('administrador.administrador.editar', compact('usuario'));
    }

    public function actualizar(Request $request, User $usuario)
    {
        return back()->with('editar', 'Se agrego Rol correctamente.');
    }

    public function eliminar(User $usuario)
    {
    }
}
