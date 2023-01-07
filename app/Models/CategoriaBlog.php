<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaBlog extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    //Relación uno a muchos inversa
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
