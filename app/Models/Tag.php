<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    //Relación muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    
    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
