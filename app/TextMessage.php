<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{
    //
    protected $fillable = ['sender', 'reciever', 'message', 'status', 'type', 'message_id'];
}
