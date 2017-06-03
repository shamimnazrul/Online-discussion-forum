<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


*/


Route::get('/home',[
    'uses'=>'\App\Http\Controllers\homeController@index',
    'as'=>'home',
    
]);



/** 
 * Sign Up
 * 
 */
Route::get('/signup',[
     'uses' => '\App\Http\Controllers\AuthController@getSignup',
    'as' => 'signup',
    'middleware' => ['guest'],
]);

Route::post('/signup',[
    'uses' => '\App\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
]);



/** 
 * Sign In
 * 
 */
Route::get('/',[
     'uses' => '\App\Http\Controllers\AuthController@getSignin',
    'as' => 'signin',
    'middleware' => ['guest'],
]);


Route::post('/',[
     'uses' => '\App\Http\Controllers\AuthController@postSignin',
    'as' => 'signin',
    'middleware' => ['guest'],
]);


/** 
 * Sign Out
 * 
 */
Route::get('/signout','AuthController@getSignout');

/** 
 * Search
 * 
 */
Route::get('/search',[
     'uses' => '\App\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
	'middleware'=>['auth'],
    
]);

/** 
 * Profile
 * 
 */
Route::get('/user/{username}',[
    'uses' => '\App\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
	'middleware'=>['auth'],
]);

/** 
 * Profile Update
 * 
 */

Route::get('/profile/update',[
    'uses' => '\App\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
	'middleware'=>['auth'],
    
]);


Route::post('/profile/update',[
    'uses' => '\App\Http\Controllers\ProfileController@postEdit',
     'as' => 'profile.edit',
	'middleware'=>['auth'],
]);

/** 
 * Status
 * 
 */
Route::post('/ask',[
    'uses' => '\App\Http\Controllers\statusController@postStatus',
   'as' => 'status.post',
    'middleware'=>['auth'],
]);


/** 
 * Reply
 * 
 */
 
Route::post('/post/{statusId}/reply',[
    'uses' => '\App\Http\Controllers\statusController@postReply',
    'as' => 'status.reply',
    'middleware'=>['auth'],
]);
 


/** 
 * Like
 * 
 */
Route::get('/post/{statusId}/like',[
    'uses' => '\App\Http\Controllers\statusController@getLike',
    'as' => 'status.like',
    'middleware'=>['auth'],
]);


/** 
 * status Edit
 * 
 */
Route::get('/post/{statusId}/edit',[
    'uses' => '\App\Http\Controllers\statusController@getEditPost',
    'as' => 'status.edit',
    'middleware'=>['auth'],
]);

Route::post('/post/{statusId}/edit',[
    'uses' => '\App\Http\Controllers\statusController@postEditPost',
    'as' => 'status.edit',
    'middleware'=>['auth'],
]);



/** 
 * status Delete
 * 
 */
Route::get('/post/{statusId}/delete',[
    'uses' => '\App\Http\Controllers\statusController@getDeletePost',
    'as' => 'status.delete',
    'middleware'=>['auth'],
]);



/** 
 * Admin signin
 * 
 */

Route::get('/admin/signin',[
       'uses'=>'\App\Http\Controllers\adminController@getAdminSignin',
       'as'=>'admin.signin',
      'middleware'=>['guest'],
    ]);


Route::post('/admin/signin',[
       'uses'=>'\App\Http\Controllers\adminController@postAdminSignin',
       'as'=>'admin.signin',
      'middleware'=>['guest'],
    ]);


/** 
 * Admin signout
 * 
 */

Route::get('/admin/signout',[
       'uses'=>'\App\Http\Controllers\adminController@getAdminSignout',
       'as'=>'admin.signout',
      'middleware'=>['auth'],
    ]);



/** 
 * Admin View
 * 
 */

Route::get('/admin',[
       'uses'=>'\App\Http\Controllers\adminController@index',
       'as'=>'admin',
      'middleware'=>['auth'],
    ]);


/** 
 * Admin User
 * 
 */

Route::get('/admin/user',[
       'uses'=>'\App\Http\Controllers\adminController@getUser',
       'as'=>'admin.user',
       'middleware'=>['auth'],

    ]);



/** 
 * Admin User Delete
 * 

 */
Route::get('/admin/user/{userId}',[
       'uses'=>'\App\Http\Controllers\adminController@getUserDelete',
       'as'=>'admin.userDelete',
       'middleware'=>['auth'],

    ]);



/** 
 * Admin Post
 * 
 */

Route::get('/admin/post',[
       'uses'=>'\App\Http\Controllers\adminController@getPost',
       'as'=>'admin.post',
       'middleware'=>['auth'],

    ]);

/** 
 * Admin Post Delete
 * 

 */
Route::get('/admin/post/{postId}',[
       'uses'=>'\App\Http\Controllers\adminController@getPostDelete',
       'as'=>'admin.postDelete',
       'middleware'=>['auth'],

    ]);


/** 
 * Admin Message
 * 
 */

Route::get('/admin/message',[
       'uses'=>'\App\Http\Controllers\adminController@getMessage',
       'as'=>'admin.message',
       'middleware'=>['auth'],

    ]);

/** 
 * Admin Message Delete
 * 

 */
Route::get('/admin/message/{msgId}',[
       'uses'=>'\App\Http\Controllers\adminController@getMessageDelete',
       'as'=>'admin.msgDelete',
       'middleware'=>['auth'],

    ]);


/** 
 * Admin Add
 * 

 */
Route::get('/admin/add/admin',[
       'uses'=>'\App\Http\Controllers\adminController@getAddAdmin',
       'as'=>'admin.addAdmin',
       'middleware'=>['auth'],

    ]);

Route::post('/admin/add/admin',[
       'uses'=>'\App\Http\Controllers\adminController@postAddAdmin',
       'as'=>'admin.addAdmin',
      'middleware'=>['auth'],
    ]);


/** 
 * User Add
 * 

 */
Route::get('/admin/add/user',[
       'uses'=>'\App\Http\Controllers\adminController@getAddUser',
       'as'=>'admin.addUser',
       'middleware'=>['auth'],

    ]);


Route::post('/admin/add/user',[
       'uses'=>'\App\Http\Controllers\adminController@postAddUser',
       'as'=>'admin.addUser',
      'middleware'=>['auth'],
    ]);


   
/** 
 * Admin Search
 * 

 */ 

 Route::get('/admin/search',[
       'uses'=>'\App\Http\Controllers\adminController@getAdminSearch',
       'as'=>'admin.search',
       'middleware'=>['auth'],

 ]);



   
/** 
 * Admin user Edit
 * 

 */ 

Route::get('/admin/edit/{username}',[
       'uses'=>'\App\Http\Controllers\adminController@getuserinfo',
       'as'=>'admin.edit',
       'middleware'=>['auth'],

 ]);

Route::post('/admin/edit/{username}',[
       'uses'=>'\App\Http\Controllers\adminController@postUserEdit',
       'as'=>'admin.edit',
       'middleware'=>['auth'],

 ]);




/**
 Route::get('/admin/edit/{userId}',[
       'uses'=>'\App\Http\Controllers\adminController@postUserEdit',
       'as'=>'admin.edit',
       'middleware'=>['auth'],

 ]);

**/



/** 
 * Message View
 * 

 */

Route::get('/message',[
       'uses'=>'\App\Http\Controllers\messageController@index',
       'as'=>'message.message',
       'middleware'=>['auth'],

    ]);


/** 
 * Message Send
 * 

 */

Route::get('/message/{userId}',[
       'uses'=>'\App\Http\Controllers\messageController@getMessageSend',
       'as'=>'message',
       'middleware'=>['auth'],

    ]);

Route::post('/message/{userId}',[
       'uses'=>'\App\Http\Controllers\messageController@postMessageSend',
       'as'=>'message',
       'middleware'=>['auth'],

    ]);


/** 
 * Message Reply
 * 

 */

Route::post('/message/reply/{userId}',[
       'uses'=>'\App\Http\Controllers\messageController@postMessageReply',
       'as'=>'message.reply',
       'middleware'=>['auth'],

    ]);



/** 
 * Message Delete
 * 

 */

Route::get('/message/delete/{msgid}',[
       'uses'=>'\App\Http\Controllers\messageController@getMessageDelete',
       'as'=>'message.delete',
       'middleware'=>['auth'],

    ]);




