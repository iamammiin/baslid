<?php

use App\Http\Controllers\Authentication\{ChangePasswordController,
    GetProfileController,
    LoginController,
    LogoutController,
    RefreshTokenController,
    RegisterController,
    UpdateController,
    UploadAvatarController};
use App\Http\Controllers\ProductStatistic\{GetEarningHistoryController, GetListController, StoreController};
use App\Http\Controllers\User\{AcceptOrRejectDiscountController,
    GetListController as GetListUserController,
    PaidController};
use Illuminate\Support\Facades\Route;

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
    Route::post('/{userId}/paid-all-product', PaidController::class);
    Route::get('/', GetListUserController::class);
});

Route::post('/product-statistic/{userDiscountCode}', StoreController::class)->where('userDiscountCode', '[0-9]+');
Route::get('/product-statistic', GetListController::class)->middleware('auth:api');
Route::get('/product-statistic/earning-history', GetEarningHistoryController::class)->middleware('auth:api');
