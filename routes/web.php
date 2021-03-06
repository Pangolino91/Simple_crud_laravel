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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect('/immagineuploadata');
})->middleware('verified');

// Route::resource('immagineuploadata', 'immagineuploadataController')->middleware('auth');

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::resource('immagineuploadata','immagineuploadataController'); 
 });

Route::get('/home', 'HomeController@index')->name('home');

// testing stuff out
Route::get('/test', 'immagineuploadataController@test');


// Email related routes
Route::get('/sendmail', 'MailController@send');
