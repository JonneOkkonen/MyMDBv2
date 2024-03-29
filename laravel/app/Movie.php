<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'movieID';
    protected $fillable = ['userID', 'name', 'type', 'runtime', 'year', 'genre',
                            'rated', 'released', 'actors', 'director', 'writer', 
                            'rating', 'rottenTomatoes', 'plot', 'posterURL'];
}
