<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gauge extends Model
{
    protected $fillable = [
        'type',
        'desempenho',
    ];
}
