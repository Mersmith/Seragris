<?php

use App\Http\Controllers\Frontend\InicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', InicioController::class)->name('inicio');

Route::get('nuestra-organizacion', function () {
    return view('frontend.organizacion.organizacion');
})->name('organizacion');
