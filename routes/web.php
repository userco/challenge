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
Route::get('/secret-one', [

	'as'        => 'qrcode',
	'uses'      => 'SecretOneController@firstpart',

 ]);
 Route::post('/secret-one', [

	'as'        => 'qrcode',
	'uses'      => 'SecretOneController@create',

 ]);
Route::get('/secret-one-view', [

	'as'        => 'qrcodeview',
	'uses'      => 'SecretOneController@create',

 ]);
 Route::get('/secret-two', [

	'as'        => 'qrcodetwo',
	'uses'      => 'SecretOneController@secondpart',

 ]);
 
 Route::post('/secret-two', [

	'as'        => 'qrcodetwo',
	'uses'      => 'SecretOneController@match',

 ]);
Route::get('/secret-two-view', [

	'as'        => 'qrcode2',
	'uses'      => 'SecretOneController@match',

 ]);