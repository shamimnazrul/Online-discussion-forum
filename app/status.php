<?php

namespace App;
use App\users;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $table='status';
    
    protected $fillable=[
        'body'
    ];
    
    public function user() {
        return $this->belongsTo('App\users','user_id');
    }
    
   public function scopeNotReply($query){
       return $query->whereNull('parent_id');
       
   }
   
   
    
   public function replies() {
       return $this->hasMany('App\status','parent_id');
   }
   
   public function likes() {
      return $this->morphMany('App\like','likeable'); 
   }
  
}
