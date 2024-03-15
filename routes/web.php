<?php

use App\Http\Controllers\ManagementController\GroupController;
use App\Http\Controllers\ManagementController\HomepageController;
use App\Http\Controllers\ManagementController\LoginController;
use App\Http\Controllers\ManagementController\ServiceController;
use App\Http\Controllers\ManagementController\UserController;
use App\Http\Middleware\CheckLogin;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\MedicineTypeModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['controller' => LoginController::class, 'prefix' => 'login', 'as' => 'login.'],function(){
    Route::get('/', 'login')->name('index');
    Route::post('process', 'processLogin')->name('processLogin');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware([CheckLogin::class])->group(function(){
    Route::get('/',[HomepageController::class,'index'])->name('index');
    Route::group(['controller' => GroupController::class, 'prefix' => 'group', 'as' => 'group.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{groupModel}', 'update')->name('update');
        Route::get('edit/{groupModel}', 'edit')->name('edit');
    });
    Route::group(['controller' => UserController::class, 'prefix' => 'user', 'as' => 'user.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{userModel}', 'edit')->name('edit');
        Route::get('detail/{userModel}', 'detail')->name('detail');
        Route::patch('update/{userModel}', 'update')->name('update');
        Route::delete('destroy/{userModel}', 'destroy')->name('destroy');
    });
    Route::group(['controller' => ServiceController::class, 'prefix' => 'service', 'as' => 'service.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{serviceModel}', 'edit')->name('edit');
        Route::get('detail/{serviceModel}', 'detail')->name('detail');
        Route::patch('update/{serviceModel}', 'update')->name('update');
        Route::delete('destroy/{serviceModel}', 'destroy')->name('destroy');
    });
    Route::group(['controller' => MedicineTypeModel::class, 'prefix' => 'medicine_type', 'as' => 'medicine_type.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicine_typeModel}', 'edit')->name('edit');
        Route::patch('update/{medicine_typeModel}', 'update')->name('update');
        Route::delete('destroy/{medicine_typeModel}', 'destroy')->name('destroy');
    });
    Route::group(['controller' => MedicineModel::class, 'prefix' => 'medicine', 'as' => 'medicine.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicineModel}', 'edit')->name('edit');
        Route::patch('update/{medicineModel}', 'update')->name('update');
        Route::delete('destroy/{medicineModel}', 'destroy')->name('destroy');
    });
    Route::group(['controller' => ManufacturerModel::class, 'prefix' => 'manufacturer', 'as' => 'manufacturer.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{manufacturerModel}', 'edit')->name('edit');
        Route::patch('update/{manufacturerModel}', 'update')->name('update');
        Route::delete('destroy/{manufacturerModel}', 'destroy')->name('destroy');
    });

});
