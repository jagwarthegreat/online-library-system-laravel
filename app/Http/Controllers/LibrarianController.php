<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Book;
use App\UserBook;
use App\User;
use Illuminate\Support\Facades\Mail;

class LibrarianController extends Controller
{
    public function home()
    {
        $reserves = UserBook::where('status_id','!=',3)->get();
    	return view('Librarian.home',compact('reserves'));
    }
    public function librarian_logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
    public function librarian_books()
    {
    	$books = Book::all();
    	return view('Librarian.books', compact('books'));
    }
    public function librarian_books_check(Request $request)
    {
        $this->validate($request, [
            'image'=> 'image|mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);
        
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);

    	$book = new Book;
    	$book->title = $request->title;
    	$book->author = $request->author;
        $book->image = $name;
    	$book->publisher = $request->publisher;
    	$book->location = $request->location;
    	$book->status_id = 0;
    	$book->save();
    	return redirect()->back()->with('suc','New Book Added!');
    }
    public function librarian_book_delete($id){
        $book =  Book::findOrFail($id);
        $book->delete();
        return redirect()->back()->with('suc','Book Deleted Successfully!');
    }

    public function librarian_books_update(Request $request)
    {
        $book = Book::findOrFail($request->input('id'));
        return $book;
    }

    public function librarian_books_update_check(Request $request)
    {
        $book = Book::findOrFail($request->input('id'));
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->location = $request->input('location');
        $book->save();
        return response()->json('success'); 
    }

    public function librarian_reservation_decline(Request $request)
    {
       
         $find = UserBook::findOrFail($request->res_id);
        

        $data = array('title'=> 'Online Library System',
                  'content'=> 'Hi this is Claudja Murawski you\'re reservation has been decline. Bacause '.$request->remark,
                  'email'=> $find->user->email
                  );
           Mail::send('Shared.email', $data, function($message) use ($data){
            $message->to($data['email'])->subject('Online Library System');
        });

         
        $book = Book::findOrFail($find->book->id);
        $book->status_id = 0;
        $book->save();
        $find->delete();
        return response()->json(1);
    }

    public function librarian_reservation_accept($id)
    {
        
        $find = UserBook::findOrFail($id);
        $find->status_id = 2;
        $find->save();

         
        $book = Book::findOrFail($find->book->id);
        $book->status_id = 2;
        $book->save();
        
        
        return redirect()->back()->with('suc','Book has been successfully Accepted!');
    }

    public function librarian_reserve_now()
    {
        $books = Book::all();
        return view('Librarian.reserve',compact('books'));
    }

    public function librarian_reserve_me($id)
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

    public function librarian_history()
    {
        $reserves  = UserBook::where('user_id',Auth::id())->get();
        return view('Librarian.history',compact('reserves'));
    }

    public function librarian_reserve_cancel($id)
    {
        $find = UserBook::findOrFail($id);
         
        $book = Book::findOrFail($find->book->id);
        $book->status_id = 0;
        $book->save();
        $find->delete();
        return redirect()->back()->with('err','Book has been successfully cancel!');
    }

    public function librarian_reserve_return($id)
    {
        $find = UserBook::findOrFail($id);
         
        $book = Book::findOrFail($find->book->id);
        $book->status_id = 0;
        $book->save();
        $find->status_id = 3;
        $find->save();
        return redirect()->back()->with('suc','Book has been successfully Returned!!');
    }

    public function librarian_change_password()
    {
        return view('librarian.change_password');
    }

    public function librarian_change_password_check(Request $request)
    {
        $find = User::findOrFail(Auth::id());
        $find->password = bcrypt($request->password);
        $find->save();
        return back()->with('suc','Password change successfully!');
    }

    public function librarian_reports(){
        
        if(empty($_GET['start']) && empty($_GET['end'])){
            $reports = UserBook::where('status_id','!=',1)->get();
        }else{
             $start = $_GET['start'];
             $end = $_GET['end'];
             $reports = UserBook::where('status_id','!=',1)->whereBetween('created_at',array($start,$end))->get(); 
        }

        return view('Librarian.report',compact('reports'));
            
               
        

      
    }

}
