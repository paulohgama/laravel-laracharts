<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donut extends Model
{
    protected $fillable = [
        'type',
        'votes',
    ];
}
