<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\status;
use App\message;
use DB;
use Auth;


class ProfileController extends Controller
{
    public function getProfile($username){
       $users= DB::table('users')->where('username',$username)->first();
       //$users= users::where('username',$username)->first();
      

        
        if(!$users){
            abort(404);
        }

           //$users= new users;  

       $post= Auth::user()->status()->notReply()->get();
        $getmsg=message::where('user_id',Auth::User()->username)
          ->orderBy('created_at','desc')->get();
        
        return view('profile.index')->with('users',$users)->with('post',$post)->with('getmsg',$getmsg);
        
    }
    
    //Profile Edit
    public function getEdit(){
		/**
            $getmsg=message::where('user_id',Auth::User()->username)
            ->orderBy('created_at','desc')->get();
            return view('profile.edit')->with('getmsg',$getmsg);
		**/
		
		return view('profile.edit');
    }
    
    public function postEdit(Request $request){
        
        $this->validate($request,[
           'firstname'=>'required|alpha|max:8',
           'lastname'=>'required|alpha|max:8',
           'address'=>'required|max:50',
        
            
        ]);
        
    
        
        Auth::user()->update([
            'firstname'=>$request->input('firstname'),
            'lastname'=>$request->input('lastname'),
            'address'=>$request->input('address'),
           
        ]);
        
        return redirect('/profile/update')->with('info','Your account has been updated successfully');
    }
}
