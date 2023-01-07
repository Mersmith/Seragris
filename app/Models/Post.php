<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'update_at'];

    //Relación uno a muchos inversa
    public function categoria_blog()
    {
        return $this->belongsTo(CategoriaBlog::class);
    }

    //Relación muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relacion uno a uno polimorfica
    public function imagen()
    {
        return $this->morphOne(Imagen::class, "imagenable");
    }
    
    public function ckeditors()
    {
        return $this->morphMany(Ckeditor::class, "ckeditorable");
    }

    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
