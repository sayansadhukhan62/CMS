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
    return view('welcome');
});

Auth::routes();

Route:: middleware(['auth'])->group(function(){

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('noob','noobController');

Route::resource('post','PostController');

Route::resource('tag','TagController');

Route::get('/recycle', 'PostController@Trash')->name('trash');

Route::get('/restore/{id}', 'PostController@Restore')->name('restore');

Route::get('/delete/{id}', 'PostController@delete')->name('delete');

Route::get('/emptyTrash', 'PostController@emptyTrash')->name('emptyTrash');

}); 