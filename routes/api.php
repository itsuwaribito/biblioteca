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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('catalogos')->group(function() {
    Route::get('libros', 'CatalogosController@getLibros');
    Route::get('alumnos', 'CatalogosController@getAlumnos');
    Route::get('secciones', 'CatalogosController@getSecciones');
    Route::get('estantes', 'CatalogosController@getEstantes');
});
Route::resource('alumnos', 'AlumnosController')->only([
    'create', 'store', 'update', 'destroy'
]);
