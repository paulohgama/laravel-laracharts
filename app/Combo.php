<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = [
        'year',
        'sales',
        'expensive',
        'net_worth',
    ];
}