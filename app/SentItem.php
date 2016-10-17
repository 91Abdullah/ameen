<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentItem extends Model
{
    protected $fillable = ['id', 'to', 'cc', 'bcc', 'subject', 'message'];
}
