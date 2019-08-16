<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coluna extends Model
{
    protected $fillable = [
        'year',
        'sales',
        'expensive',
    ];
}