<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\InvestmentPackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/hash-password', function (Request $request) {
    return \Hash::make(request()->password);
});


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::get('/my-account', 'account');
    Route::post('/refresh', 'refresh');
    Route::post('/user/change-password', 'changePassword');
});

Route::controller(CardController::class)->group(function () {
    Route::post('/user/card-setting/verify', 'setCard');
});


Route::controller(UserController::class)->group(function () {
    Route::post('/user/subscription/farm-trust', 'subscribeToFarmTrust');
    Route::post('/user/setting/farm', 'farmSetup');
    Route::get('/user/home/analytics', 'getUserHomeAnalytics');
});

Route::controller(InvestmentPackageController::class)->group(function () {
    Route::get('/investment_packages', 'index');
});

Route::controller(FoodBankController::class)->middleware(['auth:api'])->group(function () {
    Route::post('/user/foodbank', 'addMoney');
    Route::get('/user/{user_id}/foodbank', 'getUserFoodBankSavings');
    Route::get('/user/{user_id}/foodbank/analytics', 'getUserFoodBankSavingsAnalytics');
});

Route::controller(WithdrawalController::class)->middleware(['auth:api'])->group(function () {
    Route::get('/user/{user_id}/withdrawals', 'getUserWithdrawals');
});

Route::controller(SavingController::class)->middleware(['auth:api'])->group(function () {
    Route::get('/user/{user_id}/saving', 'getUserSavings');
    Route::get('/user/{user_id}/saving/analytics', 'getUserSavingsAnalytics');
    Route::post('/user/saving', 'addMoney');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{product_id}', 'getSingleProduct');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
