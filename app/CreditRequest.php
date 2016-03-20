<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditRequest extends Model
{
    //
    protected $fillable = [
        'name', 'phone', 'message', 'request_uuid', 'request_response'
    ];
}
