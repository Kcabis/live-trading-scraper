<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify', [AuthController::class, 'verify']);

Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);

