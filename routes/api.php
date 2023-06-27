<?php

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InvestmentPackageCategoryController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\InvestmentPackageController;

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
    // \Mail::to(['strattechnologies@gmail.com', 'geefive3@gmail.com'])->send(new TestMail);
    return Hash::make(request()->password);
});

Route::get('banks', [BankController::class, 'index']);

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
    Route::get('/user', 'index');
    Route::get('/user/search/by-phone', 'getUserByPhone');
    Route::patch('/user/{id}', 'updateUser');
    Route::post('/user/subscription/farm-trust', 'subscribeToFarmTrust');
    Route::post('/user/setting/farm', 'farmSetup');
    Route::get('/user/home/analytics', 'getUserHomeAnalytics');
});

Route::controller(InvestmentPackageController::class)->group(function () {
    Route::get('/investment_packages', 'index');
});

Route::controller(FoodBankController::class)->middleware(['auth:api'])->group(function () {
    Route::patch('/foodbank/{id}/approve', 'approveFoodBankSaving');
    Route::get('/foodbank', 'index');
    Route::post('/user/foodbank', 'addMoney');
    Route::get('/user/{user_id}/foodbank', 'getUserFoodBankSavings');
    Route::get('/user/{user_id}/foodbank/analytics', 'getUserFoodBankSavingsAnalytics');
});

Route::controller(WithdrawalController::class)->middleware(['auth:api'])->group(function () {
    Route::get('/user/{user_id}/withdrawals', 'getUserWithdrawals');
});

Route::controller(SavingController::class)->middleware(['auth:api'])->group(function () {
    Route::post('/savings/agent', 'agentAddMoney');
    Route::get('/savings/agent/{id}', 'getAgentSavings');
    Route::get('/user/{user_id}/saving', 'getUserSavings');
    Route::get('/user/{user_id}/saving/analytics', 'getUserSavingsAnalytics');
    Route::post('/user/saving', 'addMoney');
    Route::get('/savings', 'index');
    Route::patch('/savings/{id}/approve', 'approveSaving');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{product_id}', 'getSingleProduct');
});


Route::controller(InvestmentPackageCategoryController::class)->group(function () {
    Route::get('investment-categories', 'index');
    Route::get('investment-categories/{id}',  'show');
});

Route::controller(InvestmentPackageController::class)->group(function () {
    Route::get('investment-packages', 'index');
    Route::get('investment-packages/{id}',  'show');
});

Route::middleware(['auth:api'])->group(function () {
    Route::middleware('admin')->group(function () {

        Route::prefix('investment-categories')->name('investmentCategory.')->group(function () {
            Route::post('', [InvestmentPackageCategoryController::class, 'store']);
            Route::post('/{id}', [InvestmentPackageCategoryController::class, 'update']);
            Route::delete('/{id}', [InvestmentPackageCategoryController::class, 'destroy']);
        });

        Route::prefix('investment-packages')->name('investmentPackage.')->group(function () {
            Route::post('', [InvestmentPackageController::class, 'store']);
            Route::post('/{id}', [InvestmentPackageController::class, 'update']);
            Route::delete('/{id}', [InvestmentPackageController::class, 'destroy']);
        });
    });
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });