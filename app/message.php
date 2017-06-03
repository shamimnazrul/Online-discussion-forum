<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\users;

class message extends Model
{
    public function users(){
        $this->belongsTo('App\users','user_id','sender_id');
    }
}
