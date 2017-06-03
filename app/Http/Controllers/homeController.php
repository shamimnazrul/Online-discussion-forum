<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Auth;
use App\users;
use App\status;
use App\message;

class homeController extends Controller
{
    public function index(){
        
        if(Auth::guest()){
                return view('signin');
        }
     
     $post= status::notReply()->orderBy('created_at','desc')->paginate(10);
     

      return view('timeline.index')->with('post',$post);
     
       
       
        
    }
    

    
}
