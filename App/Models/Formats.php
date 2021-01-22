<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Formats extends Model
{
    protected $table = 'formats';
    public $timestamps = false;
    public $fillable = [
        'title'
    ];

}