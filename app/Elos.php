<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elos extends Model
{
     protected $fillable = ['type_elo', 'created_at', 'updated_at'];
     protected $guarded = ['iduser','idelo', 'created_at', 'updated_at'];
     protected $table = 'elos';
}
