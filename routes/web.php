<?php

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ScreensController;
use App\Http\Controllers\Admin\ServicesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;

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
    return redirect()->route('admin.login_view');
});


Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers'
], function () {

    Route::group(['namespace' => 'Admin', 'as' => 'admin'], function () {
        Route::get('login', 'AuthController@login_view')->name('.login_view');
        Route::post('login', 'AuthController@login')->name('.login');
        Route::get('logout', 'AuthController@logout')->name('.logout');
    });
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');


        Route::group(['namespace' => 'Admin', 'as' => 'admin'], function () {
            Route::group(['prefix' => 'screens', 'as' => '.screens'], function () {
                Route::get('/', [ScreensController::class, 'index']);
                Route::get('getData', [ScreensController::class, 'getData'])->name('.datatable');
                Route::get('/create', [ScreensController::class, 'create'])->name('.create');
                Route::post('/store', [ScreensController::class, 'store'])->name('.store');
                Route::get('/edit/{id}', [ScreensController::class, 'edit'])->name('.edit');
                Route::post('/update', [ScreensController::class, 'update'])->name('.update');
                Route::get('/show/{id}', [ScreensController::class, 'show'])->name('.show');
                Route::post('/delete', [ScreensController::class, 'delete'])->name('.delete');
                Route::post('/delete-multi', [ScreensController::class, 'deleteMulti'])->name('.deleteMulti');
            });


            Route::group(['prefix' => 'services', 'as' => '.services'], function () {
                Route::get('/', [ServicesController::class, 'index']);
                Route::get('getData', [ServicesController::class, 'getData'])->name('.datatable');
                Route::get('/create', [ServicesController::class, 'create'])->name('.create');
                Route::post('/store', [ServicesController::class, 'store'])->name('.store');
                Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('.edit');
                Route::post('/update', [ServicesController::class, 'update'])->name('.update');
                Route::get('/show/{id}', [ServicesController::class, 'show'])->name('.show');
                Route::post('/delete', [ServicesController::class, 'delete'])->name('.delete');
                Route::post('/delete-multi', [ServicesController::class, 'deleteMulti'])->name('.deleteMulti');
            });

            Route::group(['prefix' => 'brands', 'as' => '.brands'], function () {
                Route::get('/', [BrandsController::class, 'index']);
                Route::get('getData', [BrandsController::class, 'getData'])->name('.datatable');
                Route::get('/create', [BrandsController::class, 'create'])->name('.create');
                Route::post('/store', [BrandsController::class, 'store'])->name('.store');
                Route::get('/edit/{id}', [BrandsController::class, 'edit'])->name('.edit');
                Route::post('/update', [BrandsController::class, 'update'])->name('.update');
                Route::get('/show/{id}', [BrandsController::class, 'show'])->name('.show');
                Route::post('/delete', [BrandsController::class, 'delete'])->name('.delete');
                Route::post('/delete-multi', [BrandsController::class, 'deleteMulti'])->name('.deleteMulti');
            });
        });
    });
});
