<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    //protected $guarded = [];
    protected $fillable = ['video', 'title', 'duration', 'description', 'actors', 'actor_image', 'producer', 'producer_image', 'movie_logo', 'landscape_image', 'portrait_image', 'trailer'];
}
