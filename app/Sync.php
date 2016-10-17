<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sync extends Model
{
    //
    protected $fillable = ['last_sync'];

    protected $dates = ['last_sync'];
}
