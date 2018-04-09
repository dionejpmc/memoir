<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
     protected $fillable = ['idreceiver', 'idsender', 'message','status_msg'];
     protected $guarded = ['id'];
     protected $table = 'private_message';
}