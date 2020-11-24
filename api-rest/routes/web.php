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


// Cargando clases
use App\Http\Middleware\ApiAuthMiddleware;


Route::get('/', function () {
    return view('welcome');
});

	// RUTAS DEL API

    /*

	*	GET: Conseguir datos o recursos
	*	POST: Guardar datos o recursos o hacer logica desde un formulario	 
	*	PUT: Actualizar datos o recursos
	* 	DELETE: Eliminar datos o recursos

    */


		// Rutas de prueba
	    route::get('/usuario/pruebas', 'UserController@pruebas');
	    route::get('/Categoria/pruebas', 'CategoryController@pruebas');
	    route::get('/Entrada/pruebas', 'PostController@pruebas');


	    // Rutas del controlador de usuarios
	    Route::post('api/register', 'UserController@register');
	    Route::post('api/login', 'UserController@login');
	    Route::put('api/user/update', 'UserController@update');
	    Route::post('api/user/upload','UserController@upload')->middleware(ApiAuthMiddleware::class);
	    route::get('/api/user/avatar/{filename}', 'UserController@getImage');
	    route::get('/api/user/detail/{id}', 'UserController@detail');
	//	route::post('/api/prueba1', 'UserController@prueba1');
