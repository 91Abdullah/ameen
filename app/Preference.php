<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //
    protected $fillable = ['host', 'port', 'encryption', 'password', 'username', 'validate_cert'];

    public function getEncryptionAttribute($value)
    {
        if ($value == 0)
            return 'ssl';
        if ($value == 1)
            return 'tls';
    }
}
