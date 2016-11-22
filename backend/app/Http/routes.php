<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// API Routes come first
$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function($api){
    header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE');

    // API
    $api->group(['namespace'=>'App\Http\Controllers\Api'],function($api){
        // Auth
        $api->post('auth/login','Auth\AuthController@postLogin');
        $api->post('auth/token-refresh','Auth\AuthController@refreshToken');
        $api->post('users','Auth\UsersController@store');

        // Protected methods (require auth)
        $api->group(['middleware'=>'api.auth'],function($api){

        });

        // Public methods
        $api->get('/', 'App\Api\Controllers\UserController@index');

        // User view displays specific user (www.rainbowconnection.com/:user_id)
        $api->get('/{id}', 'App\Api\Controllers\UserController@show');

        // Delete friend relationship (www.rainbowconnection.com/users/:friend_one_id/friends/:friend_two_id)
        // $api->delete('App\Api\Controllers\Userusers/{friend_one_id}/friends/{friend_two_id}')

        // Test Endpoint to populate database with n amount of users (www.rainbowconnection.com/:amount_of_users)
        // post to users seed function
        $api->post('/{amount_of_users}', 'App\Api\Controllers\UserController@seed')        
    });
});

// Catchall - Displays Ember app
Route::any('{catchall}',function(){
    return view('index');
})->where('catchall', '(.*)');
