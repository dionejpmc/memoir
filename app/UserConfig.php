<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    //
     protected $fillable = ['avatarimg', 'bgimg', 'aboutme'];
     protected $guarded = ['iduser', 'created_at', 'update_at'];
     protected $table = 'userconfig';
     
}
