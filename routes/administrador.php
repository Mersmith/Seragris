<?php

use App\Http\Controllers\Administrador\InicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', InicioController::class)->name('inicio');