<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authentication\ {
    RegisterController,
    LoginController,
    GetProfileController,
    ChangePasswordController,
    LogoutController,
    RefreshTokenController,
    UploadAvatarController,
    UpdateController
};

use App\Http\Controllers\ProductStatistic\ {
    StoreController,
    GetListController,
    GetEarningHistoryController
};
use App\Http\Controllers\User\{
    AcceptOrRejectDiscountController,
    GetListController as GetListUserController

};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/profile', GetProfileController::class);
        Route::post('/change-password', ChangePasswordController::class);
        Route::post('/logout', LogoutController::class);
        Route::post('/refresh', RefreshTokenController::class);
        Route::post('/upload-avatar', UploadAvatarController::class);
        Route::patch('/update', UpdateController::class);
    });
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'users'
], function () {
    Route::post('/{userId}/accept-reject-discount', AcceptOrRejectDiscountController::class);
    Route::get('/', GetListUserController::class);
});

Route::post('/product-statistic/{userDiscountCode}', StoreController::class);
Route::get('/product-statistic', GetListController::class)->middleware('auth:api');
Route::get('/product-statistic/earning-history', GetEarningHistoryController::class)->middleware('auth:api');
