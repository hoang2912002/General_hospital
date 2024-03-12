<?php

use App\Http\Controllers\ManagementController\GroupController;
use App\Http\Controllers\ManagementController\UserController;
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
