<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'nm_vendedor',
        'dt_venda',
        'ic_status'
    ];
}
