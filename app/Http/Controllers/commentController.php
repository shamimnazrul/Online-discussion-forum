<?php

namespace App\Http\Controllers;

use Auth;
use App\status;
use Illuminate\Http\Request;

use App\Http\Requests;

class commentController extends Controller
{
        
    public function postComment(Request $request) {
        
        $this->validate($request,[
            'comment'=>'required|max:1000',
        ]);
         
       Auth::status()->comment()->create([
           'comment'=>$request->input('comment'),
       ]);
       return redirect('/')->with('info','Your comment has been posted.');
    }

    
}
