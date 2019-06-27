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

// Route::resource('user', 'UserController');
Route::post('/register', 'AuthenticationController@register');
Route::post('/login', 'AuthenticationController@login');
// Route::resource('viagem', 'ViagemController');

// //Pesquisa de viagem
Route::get('viagem/search', 'ViagemController@search')->middleware('auth:api');
// //localhost:8000/api/viagem/aveiro/porto/2019-01-01/2019-01-01

// Route::resource('tipo', 'TipoController');

// Route::resource('produto', 'ProdutoController');

// Route::resource('review', 'ReviewController');

Route::get('/user/leaderboardPoints', 'UserController@leaderboardPoints')->middleware('auth:api');

Route::get('/user/leaderboardReviews', 'UserController@leaderboardReviews')->middleware('auth:api');

Route::group(['middleware' => ['json.response']], function () {

    // Route::post('/login', 'AuthenticationController@login');

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('auth:api')->resource('/user', 'UserController');

    // Route::middleware('auth:api')->get('/user/leaderboardPoints', 'UserController@leaderboardPoints');

    Route::middleware('auth:api')->resource('/viagem', 'ViagemController');

    // Route::middleware('auth:api')->get('/viagem/search', 'ViagemController@search');
    //localhost:8000/api/viagem/aveiro/porto/2019-01-01/2019-01-01

    Route::middleware('auth:api')->resource('/tipo', 'TipoController');

    Route::middleware('auth:api')->resource('/produto', 'ProdutoController');

    Route::middleware('auth:api')->resource('/review', 'ReviewController');

    //TODO Verificar como por o schedulling e se utilizo isto
    Route::middleware('auth:api')->resource('/objectives', 'ObjectiveController');

    Route::middleware('auth:api')->group(function() {
        Route::get('/logout', 'AuthenticationController@logout');
    });
});

