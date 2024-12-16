<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
//use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;

Route::get('/register', function () {
    return view('registration');
});
Route::post('/register', [RegistrationController::class, 'store']);



Route::get('/scrape', [ScrapeController::class, 'scrape'])->name('scrape');





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
 Route::get('/events', [Dashboardcontroller::class, 'events'])->name('events');
Route::get('/listed-securities', [Dashboardcontroller::class, 'lsts'])->name('listed-securities');
Route::get("/dash",[DashboardController::class,'index'])->name('dash');

 


 // routes/web.php

 use App\Http\Controllers\ListedSecurityController;

// Route::get('/securities', [ListedSecurityController::class, 'index']);
Route::post('/upload-csv', [ListedSecurityController::class, 'uploadCsv'])->name('uploadCsv');

//event deletion
Route::delete('event/delete/{event}',[EventController::class,'delete'])->name('event.delete');
Route::delete('folioadmin/delete/{folioadmin}',[FolioadminController::class,'delete'])->name('folioadmin.delete');
//Route::get("/events",[EventController::class,'evnt'])->name('events');

//after creating layout codes
Route::get('/dash', function () {
    return view('dash');
})->name('dash');

//  Route::get('/events', function () {
//      return view('events');
// })->name('events');



Route::get('/layout', function () {
     return view('layout');
})->name('layout');

// Route::get('/listed-securities', function () {
//     return view('listed-securities');
// })->name('listed-securities');

Route::get('/account-statement', function () {
    return view('account-statement');
})->name('account-statement');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/trader-analytics', function () {
    return view('trader-analytics');
})->name('trader-analytics');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

//routes for  each section
 //Route::get('/dash', [DashboardController::class, 'index'])->name('dashboard');
 //Route::get('/events', [EventController::class, 'index'])->name('eventss');
 //Route::get('/listed-securities', [ListedSecurityController::class, 'index'])->name('listed-securities');
// Route::get('/account-statement', [AccountStatementController::class, 'index'])->name('account-statement');
// // Add more routes for other sections








