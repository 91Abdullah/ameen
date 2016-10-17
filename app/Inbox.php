<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    //
    protected $fillable = ['subject', 'date', 'message_id', 'message_no'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function froms()
    {
        return $this->hasMany('App\From');
    }

    public function tos()
    {
        return $this->hasMany('App\To');
    }

    public function ccs()
    {
        return $this->hasMany('App\Cc');
    }

    public function bccs()
    {
        return $this->hasMany('App\Bcc');
    }

    public function replyTos()
    {
        return $this->hasMany('App\ReplyTo');
    }

    public function senders()
    {
        return $this->hasMany('App\Sender');
    }

    public function body()
    {
        return $this->hasOne('App\Body');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }
}
