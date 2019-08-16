<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barra extends Model
{
    protected $fillable = [
        'foods',
        'likes',
        'unlikes',
    ];
}
