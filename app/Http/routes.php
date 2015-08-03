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

Route::get('home', 'FrontendController@showUsers');

Route::post('home', 'FrontEndController@deleteUser');

Route::get('home/addcontact', 'FrontendController@addNewContact');

Route::post('home/addcontact', 'FrontendController@store');

Route::get('edit/{slug}', 'FrontendController@editUser');

Route::post('edit/{slug}', 'FrontendController@editUser');


Route::post('edit/{slug}/delete-phone', 'FrontendController@deletePhoneNumber');
Route::post('edit/{slug}/add-phone', 'FrontendController@addPhoneNumber');

Route::post('edit/{slug}/delete-mail', 'FrontendController@deleteMail');
Route::post('edit/{slug}/add-mail', 'FrontendController@addMailNumber');


Route::get('/', function () {
    return view('frontend.index');
});

