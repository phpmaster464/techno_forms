<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\UnverifiedInstallerController;
  
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
Route::get('/clear-cache-all', function() {

    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    
    dd("Cache Clear All");

});

Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/clear_cache', [HomeController::class, 'clear_cache'])->name('clear_cache'); 
Route::get('/logout', [HomeController::class, 'getlogout'])->name('getlogout');
Route::get('/register_technician', [UnverifiedInstallerController::class, 'register_unverified_technicians'])->name('register_technician'); 
Route::post('store_unverified_installer_register', [UnverifiedInstallerController::class,'register_unverified_technicians_store'])->name('unverified_installer.register_unverified_technicians_store'); 
// Route::get('/change_status','CompanyController@change_status')->name('change_status');
  
Route::group(['middleware' => ['auth']], function() {
    Route::post('roleStatus', [RoleController::class,'change_status'])->name('role.roleStatus');
    Route::resource('roles', RoleController::class); 
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::post('companyStatus', [CompanyController::class,'change_status'])->name('company.companyStatus');
    Route::resource('company', CompanyController::class); 

    Route::post('installerStatus', [InstallerController::class,'change_status'])->name('installer.installerStatus');
    Route::resource('installer', InstallerController::class); 

     Route::post('statusStatus', [StatusController::class,'change_status'])->name('status.statusStatus');
    Route::resource('status', StatusController::class);

     Route::resource('job', JobController::class);
     Route::post('jobStatus', [JobController::class,'change_status'])->name('job.jobStatus');
	 Route::post('delete_extra_panels', [JobController::class,'delete_extra_panels'])->name('job.delete_extra_panels');
	  Route::post('delete_extra_inverter', [JobController::class,'delete_extra_inverter'])->name('job.delete_extra_inverter');

    Route::resource('inventory', InventoryController::class);
    Route::post('inventoryStatus', [InventoryController::class,'change_status'])->name('inventory.inventoryStatus');
    Route::get('inventory/model/{id}', [InventoryController::class,'model'])->name('inventory.model');
    Route::get('inventory/supplier/{id}', [InventoryController::class,'supplier'])->name('inventory.supplier');

       Route::resource('manufacturer', ManufacturerController::class);
	   Route::post('manufacturerStatus', [ManufacturerController::class,'change_status'])->name('manufacturer.manufacturerStatus');
	   
       Route::resource('model', ModelController::class);
	   Route::post('modelStatus', [ModelController::class,'change_status'])->name('model.modelStatus');
       
       Route::resource('supplier', SupplierController::class);
	   Route::post('supplierStatus', [SupplierController::class,'change_status'])->name('supplier.supplierStatus');

       Route::resource('unverified_installer', UnverifiedInstallerController::class);
       Route::post('unverified_installer', [UnverifiedInstallerController::class,'change_status'])->name('unverified_installer.verified');
});