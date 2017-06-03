<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\message;
use App\Http\Requests;

class messageController extends Controller
{
    public function index(){
        

        $username= Auth::user()->username;
      
          $getmsg=message::where('user_id','=',$username)
            ->orderBy('created_at','desc')
              ->get();
              
        
         
            
        
       
        return view('message.message')->with('getmsg',$getmsg);
    }
    
    
    
    
    
    // Message send start
    
    public function getMessageSend(){
        return view('message');
    }
    
    
    public function postMessageSend(Request $request,$userId){
        
        $this->validate($request,[
            'message'=>'required|max:1000',
        ]);
        
       
        $getusername= DB::table('users')->where('id','=',$userId)->value('username');
        
        $message= $request->input('message');
        
      $msg= DB::table('messages')->insert(
          array(
               'user_id'=>$getusername,
               'sender_id'=>Auth::user()->username,
                'body'=>$message,
               'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
           )
      );
     $msg= new message;
     
   
        return redirect()->back()->with('info','Your Message has been sent');
        
    }
    
    // Message send end
    
    
    // Message Reply start
    
    public function postMessageReply(Request $request,$userId){
        
        $this->validate($request,[
            'message'=>'required|max:1000',
        ]);
        
       
        $getusername= DB::table('messages')->where('id','=',$userId)->value('sender_id');
        
        $message= $request->input('message');
     
         $msg= DB::table('messages')->insert(
             array(
                 'user_id'=>$getusername,
                 'sender_id'=>Auth::user()->username,
                  'body'=>$message,
                  'created_at' =>  \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now(),
             )
         );
    
     
   
        return redirect()->back()->with('info','Your Message has been sent');
        
    }
    
    // Message Reply end
    

     // Message Reply start
    
    public function getMessageDelete($msgid){
        
        $msgDelete= DB::table('messages')->where('id',$msgid)->delete();
        
        return redirect('/message')->with('info','Your message has been deleted successfully');
    }
    
    // Message Reply end
 
    
}
