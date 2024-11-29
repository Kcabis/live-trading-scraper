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
    return redirect('/home');
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
Route::get('/loginad', function () {
    return view('loginad'); // This refers to registration.blade.php
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


Route::post('otp-verification', [RegistrationController::class, 'verifyOtp']);
Route::get('otp-verification/{email}', [RegistrationController::class, 'showOtpForm']);


use App\Http\Controllers\PortfolioController;

// For web routes (use api.php for APIs)
Route::get('/portfolios', [PortfolioController::class, 'getAllPortfolios']);
Route::post('/portfolio', [PortfolioController::class, 'savePortfolio']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'getPortfolio']);

use App\Http\Controllers\EventController;

Route::post('/add-event', [EventController::class, 'store']);

