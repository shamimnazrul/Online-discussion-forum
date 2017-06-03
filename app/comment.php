<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table='comment';
    
    protected $fillable=[
        'comment'
    ];
    
    public function status(){
        return $this->belongsTo('App\status','statusId');
    }
}
