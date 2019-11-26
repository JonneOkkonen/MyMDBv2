<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'movies';
    protected $fillable = ['userID', 'name', 'type', 'runtime', 'year', 'genre',
                            'rated', 'released', 'actors', 'director', 'writer', 
                            'rating', 'rottenTomatoes', 'plot', 'posterURL'];
}
