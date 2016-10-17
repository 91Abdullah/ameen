<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $fillable = ['inbox_id', 'path'];

    public function inbox()
    {
        return $this->belongsTo('App\Inbox');
    }
}
