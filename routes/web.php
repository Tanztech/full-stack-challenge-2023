<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('default');
});


//Auth::routes( ['register' => false] );
Auth::routes(  );

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth', 'role:admin,supervisor'])->group(function () {

//Routes for Referrals
    Route::get('referrals/upload', 'ReferralController@upload');
    Route::post('referrals/upload', 'ReferralController@processUpload');
    Route::get('referrals/create', 'ReferralController@create')->name('add-referral');
    Route::post('referrals', 'ReferralController@store');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // users
    Route::get('users', 'UsersController@index')->name('users-view');
});


//Routes for Posts
Route::get('posts', 'PostsController@index');
Route::post('posts', 'PostsController@store');
Route::get('posts/create', 'PostsController@create');
Route::get('posts/{post}', 'PostsController@show');

//Logged in Users
Route::get('my-posts', 'AuthorsController@posts')->name('my-posts');

//Routes for Authors
Route::get('authors', 'AuthorsController@index');
Route::get('authors/{author}', 'AuthorsController@show');

Route::get('referrals/{country?}/{city?}', 'ReferralController@index')->name('referrals-view');
Route::get('comments/{user?}', 'CommentsController@index')->name('comments');


