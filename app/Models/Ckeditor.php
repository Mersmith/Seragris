<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ckeditor extends Model
{
    use HasFactory;

    protected $fillable = ['imagen_ruta', 'imagenable_id', 'imagenable_type'];

    public function ckeditorable()
    {
        //Se puede agregar fotos desde varias tablas, para productos y ofertas
        //Se indica con que se trabaja con relación polimorfica
        return $this->morphTo();
    }
}
