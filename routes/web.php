<?php

/**
book status
0 = available
1 = pending
2 = reserve
3 = return
kindly visit pivot table user_book for relationships



*/


Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['[prefix'=> 'auth'], function(){

	Route::get('/login', [
		'as'=> 'login',
		'uses'=> 'AuthController@login'
	]);

	Route::post('/login', [
		'as'=> 'login_check',
		'uses'=> 'AuthController@login_check'
	]);

	Route::get('/register', [
		'as'=> 'register',
		'uses'=> 'AuthController@register'
	]);

	Route::post('/register', [
		'as'=> 'register_check',
		'uses'=> 'AuthController@register_check'
	]);


});

Route::group(['prefix'=> 'admin'], function(){

	Route::get('/home', [
		'as'=> 'admin',
		'uses'=> 'AdminController@home'
	]);
	Route::get('/logout', [
		'as'=> 'admin_logout',
		'uses'=> 'AdminController@admin_logout'
	]);

	Route::get('/users', [
		'as'=> 'admin_users',
		'uses'=> 'AdminController@admin_users'
	]);

	Route::post('/banned-users', [
		'as'=> 'admin_banned_users',
		'uses'=> 'AdminController@admin_banned_users'
	]);

	Route::get('/unbanned-users/{id}', [
		'as'=> 'admin_unbanned_users',
		'uses'=> 'AdminController@admin_unbanned_users'
	]);

	Route::get('/change-password', [
		'as'=> 'admin_change_password',
		'uses'=> 'AdminController@admin_change_password'
	]);
	Route::post('/change-password', [
		'as'=> 'admin_change_password_check',
		'uses'=> 'AdminController@admin_change_password_check'
	]);
});

Route::group(['prefix'=> 'librarian'], function(){

	Route::get('/home', [
		'as'=> 'librarian',
		'uses'=> 'LibrarianController@home'
	]);
	Route::get('/logout', [
		'as'=> 'librarian_logout',
		'uses'=> 'LibrarianController@librarian_logout'
	]);
	Route::get('/books', [
		'as'=> 'librarian_books',
		'uses'=> 'LibrarianController@librarian_books'
	]);
	Route::post('/books', [
		'as'=> 'librarian_books_check',
		'uses'=> 'LibrarianController@librarian_books_check'
	]);
	Route::get('/book-delete/{id}', [
		'as'=> 'librarian_book_delete',
		'uses'=> 'LibrarianController@librarian_book_delete'
	]);
	Route::post('/books-update', [
		'as'=> 'librarian_books_update',
		'uses'=> 'LibrarianController@librarian_books_update'
	]);
	Route::post('/books-update-check', [
		'as'=> 'librarian_books_update_check',
		'uses'=> 'LibrarianController@librarian_books_update_check'
	]);
	Route::post('/reservation-decline', [
		'as'=> 'librarian_reservation_decline',
		'uses'=> 'LibrarianController@librarian_reservation_decline'
	]);
	Route::get('/reservation-accept/{id}', [
		'as'=> 'librarian_reservation_accept',
		'uses'=> 'LibrarianController@librarian_reservation_accept'
	]);
	Route::get('/reserve-now', [
		'as'=> 'librarian_reserve_now',
		'uses'=> 'LibrarianController@librarian_reserve_now'
	]);
	Route::get('/reserve-me/{id}', [
		'as'=> 'librarian_reserve_me',
		'uses'=> 'LibrarianController@librarian_reserve_me'
	]);
	Route::get('/reserve-cancel/{id}', [
		'as'=> 'librarian_reserve_cancel',
		'uses'=> 'LibrarianController@librarian_reserve_cancel'
	]);
	Route::get('/reserve-return/{id}', [
		'as'=> 'librarian_reserve_return',
		'uses'=> 'LibrarianController@librarian_reserve_return'
	]);
	Route::get('/history', [
		'as'=> 'librarian_history',
		'uses'=> 'LibrarianController@librarian_history'
	]);

	Route::get('/change-password', [
		'as'=> 'librarian_change_password',
		'uses'=> 'LibrarianController@librarian_change_password'
	]);
	Route::post('/change-password', [
		'as'=> 'librarian_change_password_check',
		'uses'=> 'LibrarianController@librarian_change_password_check'
	]);

	Route::get('/reports', [
		'as'=> 'librarian_reports',
		'uses'=> 'LibrarianController@librarian_reports'
	]);
	


});

Route::group(['prefix'=> 'faculty'], function(){
	Route::get('/home', [
		'as'=> 'faculty_home',
		'uses'=> 'FacultyController@faculty_home'
	]);
	Route::get('/logout', [
		'as'=> 'faculty_logout',
		'uses'=> 'FacultyController@faculty_logout'
	]);
	Route::get('/history', [
		'as'=> 'faculty_history',
		'uses'=> 'FacultyController@faculty_history'
	]);
	Route::get('/change-password', [
		'as'=> 'faculty_change_password',
		'uses'=> 'FacultyController@faculty_change_password'
	]);

	Route::post('/change-password', [
		'as'=> 'faculty_change_password_check',
		'uses'=> 'FacultyController@faculty_change_password_check'
	]);

	Route::get('/reserve-book/{id}', [
		'as'=> 'faculty_reserve_book',
		'uses'=> 'FacultyController@faculty_reserve_book'
	]);


});

Route::group(['prefix'=> 'student'], function(){

	Route::get('/home', [
		'as'=> 'student',
		'uses'=> 'StudentController@home'
	]);
	Route::get('/logout', [
		'as'=> 'student_logout',
		'uses'=> 'StudentController@student_logout'
	]);
	Route::get('/history', [
		'as'=> 'student_history',
		'uses'=> 'StudentController@student_history'
	]);
	Route::get('/reserve-book/{id}', [
		'as'=> 'student_reserve_book',
		'uses'=> 'StudentController@student_reserve_book'
	]);
	Route::get('/cancel-book/{id}', [
		'as'=> 'student_cancel_book',
		'uses'=> 'StudentController@student_cancel_book'
	]);
	Route::get('/return-book/{id}', [
		'as'=> 'student_return_book',
		'uses'=> 'StudentController@student_return_book'
	]);
	Route::get('/change-password', [
		'as'=> 'student_change_password',
		'uses'=> 'StudentController@student_change_password'
	]);
	Route::post('/change-password', [
		'as'=> 'student_change_password_check',
		'uses'=> 'StudentController@student_change_password_check'
	]);

});