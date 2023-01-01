<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'update_at'];

    const BORRADOR = 1;
    const PUBLICADO = 2;

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    //Relación uno a muchos inversa
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, "imagenable");
    }

    public function fichas()
    {
        return $this->morphMany(Ficha::class, "fichaable");
    }

    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
