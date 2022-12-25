<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        return view('frontend.inicio.inicio');
    }
}
