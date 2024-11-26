<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
//use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;

Route::get('/register', function () {
    return view('registration');
});
Route::post('/register', [RegistrationController::class, 'store']);



Route::get('/scrape', [ScrapeController::class, 'scrape']);

Route::get('/portfolio', function () {
    return view('portfolio');
});


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/registration', function () {
    return view('registration'); // This refers to registration.blade.php
});
Route::get('/admin', function () {
    return view('admin'); // This refers to registration.blade.php
});
Route::get('/home', function () {
    return view('home');
});

use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');

Route::get('/portfolio', function () {
    if (!session('user')) {
        return redirect()->route('login')->withErrors(['You must be logged in to access the portfolio.']);
    }
    return view('portfolio');
})->name('portfolio');


use App\Http\Controllers\PortfolioController;

Route::post('/save-portfolio', [PortfolioController::class, 'store']);


Route::post('otp-verification', [RegistrationController::class, 'verifyOtp']);
Route::get('otp-verification/{email}', [RegistrationController::class, 'showOtpForm']);