<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/car/search', [CarController::class,'search'])->name('car.search');

Route::get('/car/watchlist', [CarController::class,'watchlist'])->name('car.watchlist');

Route::resource('/car', CarController::class);

Route::get('/signup', [SignupController::class, 'create'])->name('signup');

Route::get('/login', [LoginController::class, 'create'])->name('login');