<?php


namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\users;
use App\status;
use App\message;


class SearchController extends Controller
{
    
    public function getResults(Request $request){
        $query= $request->input('query') ;
        
        if(!$query){
            return redirect('/');
        }
        
      
        $users=DB::table('users')
                ->where('firstname','LIKE',"%{$query}%")
                 ->orWhere('lastname','LIKE',"%{$query}%")
                 ->orWhere('username','LIKE',"%{$query}%")
                 ->get();
     
        
         /**
            $post = status::where(function($result) use($query) {
                $result->where('body', 'like', '%'.$query.'%')
                        ->whereNull('parent_id');
            })->orderBy('created_at', 'desc')->get();
     
      **/
        $getmsg = message::where('user_id',Auth::User()->username)
          ->orderBy('created_at','desc')->get();
       return view('search.results')->with('users',$users)->with('getmsg',$getmsg);
       //return view('search.results')->with('post',$post);
       
         
     
    }
   
    
}
