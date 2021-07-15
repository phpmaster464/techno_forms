<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
  
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
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [HomeController::class, 'getlogout'])->name('getlogout');
// Route::get('/change_status','CompanyController@change_status')->name('change_status');
  
Route::group(['middleware' => ['auth']], function() {
    Route::post('roleStatus', [RoleController::class,'change_status'])->name('role.roleStatus');
    Route::resource('roles', RoleController::class); 
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::post('companyStatus', [CompanyController::class,'change_status'])->name('company.companyStatus');
    Route::resource('company', CompanyController::class); 
});