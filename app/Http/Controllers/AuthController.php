<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AuthController extends Controller
{

    public function login()
    {
    	return view('Auth.login');
    }

    public function login_check(Request $request)
    {
    	$credentials = $request->only('username','password');
    	if(Auth::attempt($credentials)){
    		if(Auth::user()->status_id == 1)
    		{
    			if(Auth::user()->role_id == 1){
    				return redirect()->route('admin');
    			}elseif(Auth::user()->role_id == 2){
    				return redirect()->route('librarian');
    			}elseif(Auth::user()->role_id == 3){
    				return redirect()->route('faculty_home');
    			}elseif(Auth::user()->role_id == 4){
    				return redirect()->route('student');
    			}
    		}else{
                $user = User::findOrFail(Auth::id());
    			return redirect()->back()->with('err','Your\'re Account has been Banned. Because'.$user->remark->remarks);
    		}
    	}else{
    		return redirect()->back()->with('err','Invalid Username/Password');
    	}
    }

    public function register()
    {
    	return view('Auth.register');

    }

    public function register_check(Request $request)
    {
    	
    	$this->validate($request,[
    		'name'=> 'required',
    		'email'=> 'email|required',
    		'username'=> 'required|min:6',
    		'password'=> 'required|min:6',
    		'repeat_password'=> 'required|same:password'
    	]);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->username = $request->username;
    	$user->password = bcrypt($request->password);
    	$user->status_id = 1;
    	$user->role_id = $request->role_id;
    	$user->save();

    	return redirect()->route('login')->with('suc','You have Registered Successfully!');
    }
}
