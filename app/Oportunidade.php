<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunidade extends Model
{
    protected $fillable = [
        'dt_oportunidade',
        'ds_status'
    ];
}
