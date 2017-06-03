<?php

namespace App\Http\Controllers;
use App\users;
use App\status;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;

class statusController extends Controller
{
    //Status post

    public function postStatus(Request $request) {
        
        
        
        $this->validate($request,[
            'status'=>'required|max:1000',
        ]);
         
  
       Auth::user()->status()->create([
           'body'=>$request->input('status'),
       ]);
       return redirect('/home')->with('info','Your status has been posted.');
    }
    
    
    //Reply Status
    public function postReply(Request $request,$statusId){
        
        $this->validate($request,[
            "reply-{$statusId}"=>'required|max:1000',
        ],[
            'required'=>'The reply body is required.',
        ]);
            
        $status= status::notReply()->find($statusId);
        if(!$status){
            return redirect('home');
        }
        $reply= status::create([
            'body'=>$request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());
           $status->replies()->save($reply);
           return redirect()->back();
    }
       
     
     //Like    
    public function getLike($statusId) {
        
        $status= status::find($statusId);
        
        if(!$status){
            return redirect('home');
        }
        
        if(Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }
        
        $like= $status->likes()->create([]);
        Auth::user()->likes()->save($like);
        return redirect()->back();
    }
    
    
    //Edit Post
    public function getEditPost($statusId) {
        
		$update= DB::table('status')->where('id',$statusId);
        return view('status.edit')->with('update',$update);
        
    }
    
    
    
    public function postEditPost(Request $request,$statusId) {
        
        $this->validate($request,[
            'body'=>'required|max:1000',
        ] );
        
       $update=status::where('id', $statusId)
            ->update([
                
                'body' =>$request->input('body'),
             
              ]);
       
       return redirect('/')->with('update',$update);
    }
    
	
    //Delete Post
    
    public function getDeletePost($statusId) {
             $delete=status::where('id', $statusId)
            ->delete();
       
       return redirect('/');
        
    }


 }