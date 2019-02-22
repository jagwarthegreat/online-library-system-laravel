<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;
use App\UserBook;
use App\User;

class FacultyController extends Controller
{
    
    public function faculty_home()
    {
    	$books = Book::all();
    	return view('Faculty.home',compact('books'));
    }

    public function faculty_logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function faculty_history()
    {
    	$reserves  = UserBook::where('user_id',Auth::id())->get();
    	return view('Faculty.history',compact('reserves'));
    }

    public function faculty_change_password()
    {
        return view('Faculty.change_password');
    }

    public function faculty_change_password_check(Request $request)
    {
        $find = User::findOrFail(Auth::id());
        $find->password = bcrypt($request->password);
        $find->save();
        return back()->with('suc','Password change successfully!');
    }

    public function faculty_reserve_book($id)
    {
        
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
}
