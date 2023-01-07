<?php

use App\Http\Controllers\Frontend\InicioController;
use App\Http\Controllers\Frontend\ProductoController;
use App\Http\Controllers\PostController;
use App\Http\Livewire\Frontend\Tienda\TiendaPagina;
use Illuminate\Support\Facades\Route;

Route::get('/', InicioController::class)->name('inicio');

Route::get('nuestra-organizacion', function () {
    return view('frontend.organizacion.organizacion');
})->name('organizacion');

Route::get('politica-del-sig', function () {
    return view('frontend.politica.politica');
})->name('politica');

Route::get('sostenibilidad', function () {
    return view('frontend.sostenibilidad.sostenibilidad');
})->name('sostenibilidad');

Route::get('conservare-tierra', function () {
    return view('frontend.conservare.conservare');
})->name('conservare');

Route::get('responsabilidad-social', function () {
    return view('frontend.responsabilidad.responsabilidad');
})->name('responsabilidad');

Route::get('contactenos', function () {
    return view('frontend.contactenos.contactenos');
})->name('contactenos');

Route::get('productos', TiendaPagina::class)->name('tienda');

Route::get('producto/{producto}', [ProductoController::class, 'mostrar'])->name('producto.index');

Route::get('blog', [PostController::class, 'index'])->name('blog.index');
Route::get('blog/{post}', [PostController::class, 'show'])->name('blog.post');