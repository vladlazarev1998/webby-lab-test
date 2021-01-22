<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    protected $table = 'actors';
    public $timestamps = false;
    public $fillable = [
        'name'
    ];

    public function films()
    {
        return $this->belongsToMany(Films::class, 'film_to_actor', 'actor_id', 'film_id');
    }

    public static function saveActors(string $actors, int $film_id)
    {

        foreach (explode(',',$actors) as $actor) {

            if (Actors::where('name', 'like', trim($actor))->get()->isNotEmpty()) {
                $actorObj = Actors::where('name', 'like', trim($actor))->get()->first();
            } else {
                $actorObj = new Actors();
                $actorObj->fill(['name' => trim($actor)])->saveOrFail();
            }

            $film_to_actor_fill = [
                'film_id' => $film_id,
                'actor_id' => $actorObj->id
            ];

            $film_to_actor = new FilmToActor();
            $film_to_actor->fill($film_to_actor_fill)->saveOrFail();
        }
    }

    public static function deleteActors($actors)
    {
        foreach ($actors as $actor) {
            $actor_ids[] = $actor->id;
            FilmToActor::where('actor_id', $actor->id)->delete();
        }
        Actors::destroy($actor_ids);
    }
}