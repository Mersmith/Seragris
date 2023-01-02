<?php

use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\InicioController;
use App\Http\Livewire\Administrador\Administrador\PaginaAdministradorAdministrador;
use App\Http\Livewire\Administrador\Categoria\PaginaCategoriaAdministrador;
use App\Http\Livewire\Administrador\Marca\PaginaMarcaAdministrador;
use App\Http\Livewire\Administrador\Perfil\PaginaPerfilAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaCrearProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaEditarProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaTodosProductoAdministrador;
use App\Http\Livewire\Administrador\Slider\PaginaSliderAdministrador;
use App\Http\Livewire\Administrador\Subcategoria\PaginaSubcategoriaAdministrador;
use Illuminate\Support\Facades\Route;

Route::get('datos-personales', PaginaPerfilAdministrador::class)->name('perfil');

Route::get('todos-los-administrador', PaginaAdministradorAdministrador::class)->name('administrador.index');
Route::controller(AdministradorController::class)->group(function () {
    Route::get('administrador/crear', 'nuevo')->name('administrador.crear');
    Route::post('administrador/crear', 'crear')->name('administrador.store');
});

Route::get('marca', PaginaMarcaAdministrador::class)->name('marca');

Route::get('categoria', PaginaCategoriaAdministrador::class)->name('categoria');
Route::get('subcategoria/{categoria}', PaginaSubcategoriaAdministrador::class)->name('subcategoria');

Route::get('producto', PaginaTodosProductoAdministrador::class)->name('producto.index');
Route::get('producto/crear', PaginaCrearProductoAdministrador::class)->name('producto.crear');
Route::get('producto/{producto}/editar', PaginaEditarProductoAdministrador::class)->name('producto.editar');

Route::get('slider', PaginaSliderAdministrador::class)->name('slider.index');
