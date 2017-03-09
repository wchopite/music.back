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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::group(['prefix' => 'v1','middleware' => 'cors'], function() {  

  Route::group(['middleware'=>'jwt.auth'], function(){
    Route::resource('genders', 'GenderController');
    Route::resource('artists', 'ArtistController');
    Route::resource('albums', 'AlbumController');
    Route::resource('users', 'UsersController');
  });

  // Authenticate routes
  Route::post('/login', 'UsersController@authenticate');
  Route::get('/logout', 'UsersController@logout');
});
