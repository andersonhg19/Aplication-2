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

Route::group(['middleware' => 'cors'],  function() {
	 Route::post('/api/register', 'UserController@register');
	 Route::post('/api/login', 'UserController@login');
	 Route::get('/api/type_documents', 'UserController@type_documents');
	 Route::get('/api/type_user', 'UserController@type_user');
	 Route::get('/api/type_communications', 'UserController@type_communications');
	 Route::get('/api/state_user', 'UserController@state_user');
	 Route::get('/api/services', 'UserController@services');



	 Route::post('api1/create_flights','flights@create_flights');
	 Route::get('api/plane'			, 'flights@plane');
	 Route::get('api/routes'		, 'flights@routes');


	 Route::post('api/user/upload','UserController@upload')->middleware(ApiAuthMiddleware::class);
	 route::get('/api/user/avatar/{filename}', 'UserController@getImage');
	 route::get('/api/user/detail/{id}', 'UserController@detail');


});

