<?php

use App\Http\Controllers\ManagementController\GroupController;
use App\Http\Controllers\ManagementController\HomepageController;
use App\Http\Controllers\ManagementController\LoginController;
use App\Http\Controllers\ManagementController\ManufacturerController;
use App\Http\Controllers\ManagementController\MedicineController;
use App\Http\Controllers\ManagementController\MedicineTypeController;
use App\Http\Controllers\ManagementController\RoomController;
use App\Http\Controllers\ManagementController\ServiceController;
use App\Http\Controllers\ManagementController\ShiftController;
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
    //Homepage
    Route::get('/',[HomepageController::class,'index'])->name('index');
    //Group
    Route::group(['controller' => GroupController::class, 'prefix' => 'group', 'as' => 'group.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{groupModel}', 'update')->name('update');
        Route::get('edit/{groupModel}', 'edit')->name('edit');
    });
    //User
    Route::group(['controller' => UserController::class, 'prefix' => 'user', 'as' => 'user.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{userModel}', 'edit')->name('edit');
        Route::get('detail/{userModel}', 'detail')->name('detail');
        Route::patch('update/{userModel}', 'update')->name('update');
        Route::delete('destroy/{userModel}', 'destroy')->name('destroy');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
        Route::get('profile','profile')->name('profile');
        Route::get('setting','setting')->name('setting');
    });
    //Service
    Route::group(['controller' => ServiceController::class, 'prefix' => 'service', 'as' => 'service.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('dropzone', 'dropzone')->name('dropzone');
        Route::get('readFiles/{serviceModel}', 'readFiles')->name('readFiles');
        Route::get('readFilesThumbnail/{serviceModel}', 'readFilesThumbnail')->name('readFilesThumbnail');
        Route::get('edit/{serviceModel}', 'edit')->name('edit');
        Route::get('detail/{serviceModel}', 'detail')->name('detail');
        Route::patch('update/{serviceModel}', 'update')->name('update');
        Route::delete('destroy/{serviceModel}', 'destroy')->name('destroy');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
    });
    //Medicine_type
    Route::group(['controller' => MedicineTypeController::class, 'prefix' => 'medicine_type', 'as' => 'medicine_type.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicine_typeModel}', 'edit')->name('edit');
        Route::patch('update/{medicine_typeModel}', 'update')->name('update');
        Route::delete('destroy/{medicine_typeModel}', 'destroy')->name('destroy');
    });
    //Medicine
    Route::group(['controller' => MedicineController::class, 'prefix' => 'medicine', 'as' => 'medicine.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicineModel}', 'edit')->name('edit');
        Route::patch('update/{medicineModel}', 'update')->name('update');
        Route::delete('destroy/{medicineModel}', 'destroy')->name('destroy');
    });
    //Manufacturer
    Route::group(['controller' => ManufacturerController::class, 'prefix' => 'manufacturer', 'as' => 'manufacturer.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{manufacturerModel}', 'edit')->name('edit');
        Route::patch('update/{manufacturerModel}', 'update')->name('update');
        Route::delete('destroy/{manufacturerModel}', 'destroy')->name('destroy');
    });
    //Room
    Route::group(['controller' => RoomController::class, 'prefix' => 'room', 'as' => 'room.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{roomModel}', 'edit')->name('edit');
        Route::patch('update/{roomModel}', 'update')->name('update');
        Route::delete('destroy/{roomModel}', 'destroy')->name('destroy');
    });
    //Shift
    Route::group(['controller' => ShiftController::class, 'prefix' => 'shift', 'as' => 'shift.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{shiftModel}', 'edit')->name('edit');
        Route::patch('update/{shiftModel}', 'update')->name('update');
        Route::delete('destroy/{shiftModel}', 'destroy')->name('destroy');
    });

});
