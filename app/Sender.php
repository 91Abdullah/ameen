<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    //
    protected $fillable = ['mailbox', 'host', 'personal', 'mail', 'full'];

    public function inbox()
    {
        return $this->belongsTo('App\Inbox');
    }
}
