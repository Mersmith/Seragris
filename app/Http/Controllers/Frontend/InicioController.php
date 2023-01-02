<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        $sliders = Slider::where('estado', '0')->orderBy('posicion', 'desc')->get();

        return view('frontend.inicio.inicio', compact('sliders'));
    }
}
