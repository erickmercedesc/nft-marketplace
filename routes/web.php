<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserDepositController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ReferalController;
use App\Http\Controllers\ReinvestController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\Admin\SecretController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return view('welcome');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('tokens', TokenController::class);

    Route::middleware('user')->group(function(){
        Route::post('tokens/{token}/purchase', [TokenController::class, 'purchase'])->name('tokens.purchase');

        Route::get('deposits/{currency}/address', [DepositController::class, 'address'])->name('deposits.address');
        Route::resource('deposits', DepositController::class);
    });

    Route::middleware('admin')->name('admin.')->group(function(){
        Route::resource('users', UserController::class)->middleware('can:users');
        Route::resource('users.deposits', UserDepositController::class)->shallow()->only(['index', 'store', 'destroy'])->middleware('can:users');
        Route::resource('settings', SettingController::class)->middleware('can:settings');
    });
});

