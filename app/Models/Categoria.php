<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    //Una Categoria puede tener varias subcategorias
    //Relación uno a muchos
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }

    //Muchas Categorias puede tener varias marcas
    //Relación muchos a muchos
    //Una Categoria pertenece y tiene muchas Marcas
    public function marcas()
    {
        return $this->belongsToMany(Marca::class);
    }

    public function productos()
    {
        return $this->hasManyThrough(Producto::class, Subcategoria::class);
    }

    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
