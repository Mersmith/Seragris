<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['lugar', 'short_link_id'];


    public function shortLink()
    {
        return $this->belongsTo(ShortLink::class);
    }
}
