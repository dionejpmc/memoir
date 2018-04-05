<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoirFeedMsg extends Model
{
     protected $fillable = ['memoirtitle', 'memoirtext','urlimg'];
     protected $guarded = ['id', 'created_at', 'update_at'];
     protected $table = 'memoirfeedmsg';
}
