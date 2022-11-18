<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\auth\AuthController;
use App\Http\Controllers\Api\V1\user\HomeController;
use App\Http\Controllers\Api\V1\app\SettingsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => "V1", 'namespace' => 'V1'], function () {
    Route::group(['prefix' => "app"], function () {
        //main screens
        Route::get('/screens', [SettingsController::class, 'screens']);
        Route::get('/settings', [SettingsController::class, 'settings']);
        Route::get('/custom_settings', [SettingsController::class, 'custom_settings_keys']);
        Route::get('/settings/{key}', [SettingsController::class, 'custom_settings']);
        Route::get('/pages/{type}', [SettingsController::class, 'pages']);
    });
    Route::group(['prefix' => "auth"], function () {
        //auth
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/sign-up', [AuthController::class, 'SignUp']);
        Route::post('/verify', [AuthController::class, 'Verify']);
        Route::post('/resend-code', [AuthController::class, 'resendCode']);
        Route::post('/forget-password', [AuthController::class, 'ForgetPassword']);
        Route::post('/check_location', [AuthController::class, 'check_location']);
        Route::post('/social-login', [AuthController::class, 'socialLogin']);
    });
    Route::group(['middleware' => ['auth:api', 'check_active']], function () {

        Route::group(['prefix' => "auth"], function () {
            Route::post('/change-password', [AuthController::class, 'changePassword']);
            Route::post('/update-profile', [AuthController::class, 'UpdateProfile']);
        });
        Route::group(['prefix' => "user"], function () {
            //home

        });
    });
});
