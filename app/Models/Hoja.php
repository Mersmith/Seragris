<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoja extends Model
{
    use HasFactory;

    protected $fillable = ['hoja_ruta', 'hojaable_id', 'hojaable_type'];

    public function hojaable()
    {
        //Se puede agregar fotos desde varias tablas, para productos y ofertas
        //Se indica con que se trabaja con relación polimorfica
        return $this->morphTo();
    }
}
