<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FilmToActor extends Model
{
    protected $table = 'film_to_actor';
    public $timestamps = false;
    public $fillable = [
        'film_id',
        'actor_id'
    ];
}