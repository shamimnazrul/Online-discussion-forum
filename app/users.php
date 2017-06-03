<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;





class users extends Model implements AuthenticatableContract 
{
    use Authenticatable;
    
      protected $table = 'users';
        protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'address',
    ];


    protected $hidden = [
        'password', 
        'remember_token',
    ];
    
    
    public function status() {
        return $this->hasMany('App\status','user_id');
    }
    
    public function likes() {
        return $this->hasMany('App\like','user_id');
    }
    
    public function hasLikedStatus(status $status) {
        
        return (bool) $status->likes
                ->where('likeable_id',$status->id)
                ->where('likeable_type',  get_class($status))
                ->where('user_id',  $this->id)
                ->count();
    }


    public function messages() {
        $this->hasMany('App\message','user_id','sender_id');
    }



    
}    
    
