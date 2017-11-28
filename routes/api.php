<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
     ->get('/user', function (Request $request) {
         return $request->user();
     });

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::get('clients', 'Clients@loadAll')->middleware('auth:api');
Route::post('clients','Clients@import')->middleware('auth:api');

Route::get('client/{id}', 'Clients@load')->middleware('auth:api');
Route::post('client/', 'Clients@create')->middleware('auth:api');
Route::put('client/{id}', 'Clients@change')->middleware('auth:api');
Route::delete('client/{id}', 'Clients@delete')->middleware('auth:api');



