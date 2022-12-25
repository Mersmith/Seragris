<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        return view('administrador.inicio.inicio');
    }}
