<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::middleware(['jwt.verify'])->group(function(){
    Route::get('user', 'UserController@getAuthenticatedUser');

    //iklan
    Route::get('iklan', "IklanController@index"); //read iklan
	Route::get('iklan/{limit}/{offset}', "IklanController@getAll"); //read iklan
	Route::post('iklan', 'IklanController@store'); //create iklan
	Route::put('iklan/{id}', "IklanController@update"); //update iklan
	Route::delete('iklan/{id}', "IklanController@delete"); //delete iklan
});