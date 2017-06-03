<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Pagination\Paginator;
use Auth;
use App\Http\Requests;
use App\users;
use App\status;

use DB;



class adminController extends Controller
{



     public function index(){
        return view('admin.home');
    }

   // Admin Sign In Start

     public function getAdminSignin(){
        return view('admin.signin');
     }

     public function postAdminSignin(Request $request){

        $this->validate($request,[
                 'email'=>'required',
                 'password'=>'required',

            ]);

        $email= $request->input('email');
        $password= $request->input('password');

        if(Auth::attempt(['email'=>$email, 'password'=>$password, 'admin'=>1])){
            return redirect('/admin');
        }


        return redirect('/admin/signin')->with('danger','Invalid email or password');

  }
 
       //Admin Sign In end
     


      public function getAdminSignout(){
         Auth::logout();
         return redirect('/admin/signin');
      }





//Admin User fetch start
    public function getUser(){
    	//$user= DB::table('users')->paginate(10);
    	$users=users::paginate(50);

    	return view('admin.user')->with('users',$users);
    }
     
     public function getUserDelete($userId){
     	$user= users::where('id',$userId)->delete();
     	return redirect('/admin/user');


     }


     

//Admin User fetch end


//Admin post fetch start
     public function getPost(){
            
            $post= status::paginate(50);

            return view('admin.post')->with('post',$post);

     }


     public function getPostDelete($postId){
     	$post= status::where('id',$postId)->delete();
     	return redirect('/admin/post');


     }
//Admin post fetch end


     //Add Admin

     public function getAddAdmin(){
        return view('admin.addAdmin');
     }

    public function postAddAdmin(Request $request){

        $this->validate($request,[
           'email'=>'required|unique:users|email|max:255',
           'username'=>'required|unique:users|max:20',
           'password'=>'required|min:6',

        ]);

        $email= $request->input('email');
        $username= $request->input('username');
        $password= $request->input('password');

        $admin= new users;
        
        $admin->username= $username;
        $admin->email=$email;
        $admin->password= bcrypt($password);
        $admin->admin= TRUE;
        $admin->save();
        

        return redirect('/admin/user')->with('info','Your account create successfully');
    }



     //Add User
    
       public function getAddUser(){
        return view('admin.addUser');
     }
     
     public function postAddUser(Request $request) {

        $this->validate($request,[
            'email'=>'required|unique:users|email|max:255',
           'username'=>'required|unique:users|max:20',
           'password'=>'required|min:6',
        
        ]);
        
        $email= $request->input('email');
        $username= $request->input('username');
        $password= $request->input('password');

        $user= new users;

        $user->username= $username;
        $user->email=$email;
        $user->password= bcrypt($password);
        $user->admin= FALSE ;
        $user->save();
        
         return redirect('/admin/user')->with('info','Your account create successfully');
     }
     
  
 //Admin Message fetch start
     public function getMessage(){
            
            $msg= DB::table('messages')->paginate(50);

            return view('admin.message')->with('msg',$msg);

     }


     public function getMessageDelete($msgId){
     	$msg= DB::table('messages')->where('id',$msgId)->delete();
     	return redirect('/admin/message');


     }
//Admin Message fetch end

//Admin Search start

   public function getAdminSearch(Request $request){
       $query= $request->input('query');

       if(!$query){
           return redirect('/admin/user');
       }

               $users=DB::table('users')
                ->where('firstname','LIKE',"%{$query}%")
                 ->orWhere('lastname','LIKE',"%{$query}%")
                 ->orWhere('username','LIKE',"%{$query}%")
                 ->get();

        return view('admin.results')->with('users',$users);
   }  

//Admin Search end


//Admin User Count start


public function getUserCount(){

    $userNumber= users::count();

    return view('admin.user')->with('userNumber',$userNumber);
}



//Admin User Count end	
	
	
//Admin User Edit start
	
	
	 public function getuserinfo($username){
       $users= DB::table('users')->where('username',$username)->first();
		 
		 
		 return view('admin.edit')->with('users',$users);
		 
	 }


	public function postUserEdit(Request $request,$username){
	  
    
		$this->validate($request,[
			'admin'=>'required',
		]);
        
        DB::table('users')
            ->where('username',$username)
            ->update(['admin' => $request->input('admin')]);
        
        return redirect('/admin/user');
    }

			
	
	
	
	
//Admin User Edit end

}
