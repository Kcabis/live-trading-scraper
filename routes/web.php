<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
//use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RegistrationController;

Route::get('/register', function () {
    return view('registration');
});
Route::post('/register', [RegistrationController::class, 'store']);



Route::get('/scrape', [ScrapeController::class, 'scrape']);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/portfolio', function () {
    return view('portfolio');
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





// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/verify', [AuthController::class, 'verify']);

// Route::post('/send-otp', [OtpController::class, 'sendOtp']);
// Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);
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



