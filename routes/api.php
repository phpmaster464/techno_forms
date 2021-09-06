<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController; 
use App\Http\Controllers\PostController;
use App\Http\Controllers\API\AuthController; 
 

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

$namespace = 'App\Http\Controllers\Api';


Route::group(['prefix' => 'v1','middleware' => ['throttle','cors']], function () use ($namespace) {
Route::post('register', [PassportAuthController::class, 'register']);
// Route::post('login', [PassportAuthController::class, 'login']);
Route::post('installer_login','App\Http\Controllers\Api\PassportAuthController@installer_login');

Route::post('refresh_token','App\Http\Controllers\Api\PassportAuthController@generate_auth_token_using_refresh_token');
Route::post('forgot-password','App\Http\Controllers\Api\AuthController@forgot_password');
Route::post('change-password','App\Http\Controllers\Api\AuthController@change_password'); 
	
	Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('api_logout','App\Http\Controllers\Api\PassportAuthController@api_logout');
});

});




