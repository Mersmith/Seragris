<?php

use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\Ckeditor5Controller;
use App\Http\Controllers\Administrador\InicioController;
use App\Http\Livewire\Administrador\Administrador\PaginaAdministradorAdministrador;
use App\Http\Livewire\Administrador\Categoria\PaginaCategoriaAdministrador;
use App\Http\Livewire\Administrador\CategoriaBlog\PaginaCategoriaBlog;
use App\Http\Livewire\Administrador\Marca\PaginaMarcaAdministrador;
use App\Http\Livewire\Administrador\Perfil\PaginaPerfilAdministrador;
use App\Http\Livewire\Administrador\Post\PaginaCrearPost;
use App\Http\Livewire\Administrador\Post\PaginaEditarPost;
use App\Http\Livewire\Administrador\Post\PaginaTodosPost;
use App\Http\Livewire\Administrador\Producto\PaginaCrearProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaEditarProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaTodosProductoAdministrador;
use App\Http\Livewire\Administrador\ShortLink\ShortLinkInicio;
use App\Http\Livewire\Administrador\ShortLink\ShortLinkMostrar;
use App\Http\Livewire\Administrador\Slider\PaginaSliderAdministrador;
use App\Http\Livewire\Administrador\Subcategoria\PaginaSubcategoriaAdministrador;
use App\Http\Livewire\Administrador\Tag\PaginaTag;
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

Route::get('categoria-blog', PaginaCategoriaBlog::class)->name('categoria.blog');
Route::get('tag', PaginaTag::class)->name('tag');

Route::get('post', PaginaTodosPost::class)->name('post.index');
Route::get('post/crear', PaginaCrearPost::class)->name('post.crear');
Route::get('post/{post}/editar', PaginaEditarPost::class)->name('post.editar');

Route::post('ckeditor-upload', [Ckeditor5Controller::class, 'upload'])->name('ckeditor.upload');

Route::get('recortar-link', ShortLinkInicio::class)->name('shortlink.index');
Route::get('recortar-link/{shortlink}', ShortLinkMostrar::class)->name('shortlink.mostrar');


