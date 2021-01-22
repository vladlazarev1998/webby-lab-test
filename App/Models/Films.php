<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    protected $table = 'films';
    public $timestamps = false;
    public $fillable = [
        'title',
        'release_date',
        'format_id'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actors::class, 'film_to_actor', 'film_id', 'actor_id');
    }

    public function format()
    {
        return $this->hasOne(Formats::class, 'id', 'format_id');
    }

    public function addFilm(array $data)
    {
        $film = new Films();
        $film->fill($data)->saveOrFail();
        Actors::saveActors($data['actors'], $film->id);
    }

    public function updateFilm(array $data, int $film_id)
    {
        $film = Films::find($film_id);
        $film->fill($data)->saveOrFail();

        Actors::deleteActors($film->actors);
        Actors::saveActors($data['actors'], $film_id);
    }

    public static function deleteFilm(int $film_id)
    {
        $film = Films::findOrFail($film_id);
        Actors::deleteActors($film->actors);
        $film->delete();
    }

}