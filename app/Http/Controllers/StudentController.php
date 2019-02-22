<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;
use App\UserBook;
use App\User;

class StudentController extends Controller
{
    public function home()
    {
    	$books = Book::all();
    	return view('Student.home',compact('books'));
    }
    public function student_logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
    public function student_history()
    {
    	$reserves  = UserBook::where('user_id',Auth::id())->get();
    	return view('Student.history',compact('reserves'));
    }
    public function student_reserve_book($id)
    {
        $check_point = UserBook::where('user_id',Auth::id())->where('status_id',1)->first();
        if($check_point){
            return redirect()->back()->with('err','You are only allowed to reserved once.!'); 
        }
    	$book_find = Book::findOrFail($id);

    	$user_book = new UserBook;
    	$user_book->book_id = $book_find->id;
    	$user_book->user_id = Auth::id();
        $user_book->status_id = 1;
    	$user_book->save();

    	$book_find->status_id = 1;
    	$book_find->save();
    	return redirect()->back()->with('suc','Book has been successfully reserve!');
    }
    public function student_cancel_book($id)
    {
    	$find = UserBook::findOrFail($id);
    	 
    	$book = Book::findOrFail($find->book->id);
    	$book->status_id = 0;
    	$book->save();
    	$find->delete();
    	return redirect()->back()->with('err','Book has been successfully cancel!');
    }
    public function student_return_book($id)
    {
        $find = UserBook::findOrFail($id);
         
        $book = Book::findOrFail($find->book->id);
        $book->status_id = 0;
        $book->save();
        $find->status_id = 3;
        $find->save();
        return redirect()->back()->with('suc','Book has been successfully Returned!!');
    }

    public function student_change_password()
    {
        return view('Student.change_password');
    }

    public function student_change_password_check(Request $request)
    {
        $find = User::findOrFail(Auth::id());
        $find->password = bcrypt($request->password);
        $find->save();
        return back()->with('suc','Password change successfully!');
    }
}
