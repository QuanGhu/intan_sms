<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $fillable = [
        'device_id', 'phone_number','message','message_id','status'
    ];
}
