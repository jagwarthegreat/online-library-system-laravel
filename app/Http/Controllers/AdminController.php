<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserRemark;

class AdminController extends Controller
{
    public function home()
    {
    	return view('Admin.home');
    }
    public function admin_logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
    public function admin_users()
    {
    	$users = User::where('role_id','!=',1)->get();
    	return view('Admin.users',compact('users'));
    }
    public function admin_banned_users(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status_id = 0;
        $user->save();

        $remark = new UserRemark;
        $remark->user_id = $request->user_id;
        $remark->remarks = $request->remark;
        $remark->save();
        return response()->json(1);
    }

    public function admin_unbanned_users($id){
        $user = User::findOrFail($id);
        $user->status_id = 1;
        $user->save();
        return redirect()->back()->with('suc','User has been Unbanned');
    }

    public function admin_change_password()
    {
        return view('Admin.change_password');
    }

    public function admin_change_password_check(Request $request)
    {
        $find = User::findOrFail(Auth::id());
        $find->password = bcrypt($request->password);
        $find->save();
        return back()->with('suc','Password change successfully!');
    }
}
