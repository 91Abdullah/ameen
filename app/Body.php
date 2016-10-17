<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    //
    protected $fillable = ['type', 'content'];

    public function inbox()
    {
        return $this->belongsTo('App\Inbox');
    }
}
