<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\users;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;




class AuthController extends Controller
{

    public function getSignup(){
        return view('signup');

    }

    public function postSignup(Request $request){

        $this->validate($request,[
           'email'=>'required|unique:users|email|max:255',
           'username'=>'required|unique:users|max:20',
           'password'=>'required|min:6',

        ]);

        users::create([

            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>  bcrypt($request->input('password')),
        ]);

        return redirect('/')->with('info','Your account create successfully !!!. You can log in now....');
    }

    public function getSignin(){
        return view('signin');

    }



    public function postSignin(Request $request){

        $this->validate($request,[
           'email'=>'required',
           'password'=>'required',
        ]);

        if(!Auth::attempt($request->only(['email','password']),$request->has('remember'))){
           return redirect('/')->with('danger','Invalid Email or Password');
        }

         return redirect('/home')->with('info','You are logged in');
    }


    public function getSignout(){
        Auth::logout();

        return redirect('/');
    }
    
    
    





}
