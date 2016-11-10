<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cdr extends Model
{
    //
    protected $connection = 'asterisk';
    protected $table = 'cdr';
    protected $dates = [
        'calldate'
    ];
}
