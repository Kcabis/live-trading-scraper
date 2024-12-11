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




Route::get('/', function () {
    return redirect('/home');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/registration', function () {
    return view('registration'); // This refers to registration.blade.php
});
// Route::get('/admin', function () {
//     return view('admin'); // This refers to registration.blade.php
// });
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

Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');

Route::post('otp-verification', [RegistrationController::class, 'verifyOtp']);
Route::get('otp-verification/{email}', [RegistrationController::class, 'showOtpForm']);



//portfolio controler
use App\Http\Controllers\PortfolioController;

// For web routes (use api.php for APIs)
//Route::get('/portfolios', [PortfolioController::class, 'getAllPortfolios']);
//Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
//Route::post('/add-ph',[PortfolioController::class,'save']);
//Route::get('/portfolio/{id}', [PortfolioController::class, 'getPortfolio']);
Route::post('/add-ph', [PortfolioController::class, 'store']);


use App\Http\Controllers\StocksController;
Route::post('/add-stock', [StocksController::class, 'store']);



//event controller
 use App\Http\Controllers\EventController;
 use App\Http\Controllers\FolioadminController;

// Route::get('/admin', [EventController::class, 'index'])->name('admin');
 Route::post('/add-event', [EventController::class, 'store']);

// Route::get('/admin',[FolioadminController::class,'index']);
 Route::post('/add-ad', [FolioadminController::class, 'store']);


// Route::get('/folioadmins', [FolioadminController::class, 'index'])->name('folioadmins');

//use App\Http\Controllers\FolioadminController;

// Route::get('/admin', [FolioadminController::class, 'index'])->name('admin.index');
//Route::post('/add-ad', [FolioadminController::class, 'store'])->name('admin.store');


use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

 use App\Http\Controllers\Dashboardcontroller;
 Route::get('/portfolio', [Dashboardcontroller::class, 'index'])->name('dashboard');

 // routes/web.php

 use App\Http\Controllers\ListedSecurityController;

// Route::get('/securities', [ListedSecurityController::class, 'index']);
Route::post('/upload-csv', [ListedSecurityController::class, 'uploadCsv'])->name('uploadCsv');

//event deletion
Route::delete('event/delete/{event}',[EventController::class,'delete'])->name('event.delete');
Route::delete('folioadmin/delete/{folioadmin}',[FolioadminController::class,'delete'])->name('folioadmin.delete');








