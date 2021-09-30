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

Route::get('list-installer-jobs','App\Http\Controllers\Api\ApplicationApiController@installer_job_list'); 
Route::post('job-start-end','App\Http\Controllers\Api\ApplicationApiController@job_start_end');   
Route::post('scan-panel-serial-number','App\Http\Controllers\Api\ApplicationApiController@scan_panel_serial_number');    
Route::post('scan-inverter-serial-number','App\Http\Controllers\Api\ApplicationApiController@scan_inverter_serial_number');    
Route::post('upload-panel-image','App\Http\Controllers\Api\ApplicationApiController@upload_panel_image');    
Route::post('upload-inverter-image','App\Http\Controllers\Api\ApplicationApiController@upload_inverter_image');
Route::post('delete-job-image','App\Http\Controllers\Api\ApplicationApiController@delete_job_image');
Route::post('upload-job-image','App\Http\Controllers\Api\ApplicationApiController@upload_job_image');
Route::post('job-list-count-upload','App\Http\Controllers\Api\ApplicationApiController@job_list_count');     
Route::post('job-list-count-upload-new','App\Http\Controllers\Api\ApplicationApiController@job_list_count_new');     
}); 
	 
	Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('api_logout','App\Http\Controllers\Api\PassportAuthController@api_logout');
}); 

});  




