<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
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

