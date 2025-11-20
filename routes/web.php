<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ChartOfAccountsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\VendorController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('bank-accounts.index');
    }
    return redirect()->route('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('admin.loginPost');
});




Route::middleware('auth')->group(function () {
    Route::resource('bank-accounts', BankController::class);
    Route::resource('chart-of-accounts', ChartOfAccountsController::class);
    Route::resource('departments', DepartmentsController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('vendors', VendorController::class);
    Route::get('hak-akses', [HakAksesController::class, 'index'])->name('hak-akses.index');
    Route::post('hak-akses/store', [HakAksesController::class, 'store'])->name('hak-akses.store');
});

Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->name('refresh.csrf');


Route::get('/paksa-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Anda telah logout.');
});
