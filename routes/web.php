<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\CarBuyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/cars/create',[CarBuyController::class,'create'])->name('cars.create');
    Route::post('/cars/store',[CarBuyController::class,'store'])->name('cars.store');
    Route::get('/cars/{car}/edit',[CarBuyController::class,'edit'])->name('cars.edit');
    Route::put('/cars/{car}',[CarBuyController::class,'update'])->name('cars.update');
    Route::delete('cars/{car}',[CarBuyController::class,'destroy'])->name('cars.destroy');
    Route::get('/cars',[CarBuyController::class,'show'])->name('cars.show');
    Route::get('/cars/search', [CarBuyController::class, 'search'])->name('cars.search');
    Route::get('cars/{car}/view_details', [CarBuyController::class, 'view_details'])->name('cars.view_details');
});

Route::get('/', [CarBuyController::class,'index']);

// Register routes
Route::view('/register','auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register',Register::class)
    ->middleware('guest');

// Logout
    Route::post('/logout',Logout::class)
    ->middleware('auth'); // it means that only who is authenticated can logout

// Login
    Route::view('/login','auth.login')
        ->middleware('guest')
        ->name('login');

    Route::post('login',Login::class)
        ->middleware('guest');
