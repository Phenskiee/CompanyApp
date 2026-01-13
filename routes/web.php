<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompanyListController;
use App\Http\Controllers\CompanyResponseController;

Route::get('/', [AppController::class, 'index'])->name('app');

Route::get('/dashboard/counts', [AppController::class, 'dashboardCounts'])
    ->name('dashboard.counts');

Route::get('/dropdown', [AppController::class, 'getDropdownStatus'])->name('dropdown.list');

Route::get('/platform', [AppController::class, 'getDropdownPlatform'])->name('dropdown.platform');

Route::get('/setup', [AppController::class, 'getDropdownSetup'])->name('dropdown.setup');

Route::get('/personal-info', [AppController::class, 'getPersonalInfo'])->name('personal.info');

// ACCOUNT
Route::prefix('account')->controller(AccountController::class)->group(function() {
    Route::get('/table', 'accounts')->name('account.table');
    Route::post('/table', 'store')->name('account.store');
    Route::put('/update/{id}', 'update')->name('account.update');
    Route::delete('/delete/{id}', 'destroy')->name('account.destroy');
});

// COMPANY LIST
Route::prefix('company')->controller(CompanyListController::class)->group(function() {
    Route::get('/table', 'companyList')->name('company.table');
    Route::post('/table', 'store')->name('company.store');
    Route::put('/update/{id}', 'update')->name('company.update');
    Route::delete('/delete/{id}', 'destroy')->name('company.destroy');
    Route::get('/show/{id}', 'show')->name('company.show');

    Route::post('/apply', 'apply')->name('response.apply');
});

// COMPANY RESPONSE
Route::prefix('response')->controller(CompanyResponseController::class)->group(function() {
    Route::get('/table', 'companyResponse')->name('response.table');
    Route::get('/show/{id}', 'show')->name('response.show');
    Route::put('/update/{id}', 'update')->name('response.update');
});