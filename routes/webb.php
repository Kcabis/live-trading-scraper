<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\FolioadminController;

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
    return view('registration'); 
});

Route::get('/home', function () {
    return view('home');
});
Route::get('/loginad', function () {
    return view('loginad'); 
});


use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/loginad', [FolioadminController::class, 'loginad']);




Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');

Route::post('otp-verification', [RegistrationController::class, 'verifyOtp']);
Route::get('otp-verification/{email}', [RegistrationController::class, 'showOtpForm']);



use App\Http\Controllers\PortfolioController;
Route::post('/update-portfolio', [PortfolioController::class, 'updatePortfolio'])->name('portfolio.update');
Route::delete('/delete-portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('portfolio.delete');
Route::get("/history",[PortfolioController::class,'hist'])->name('history');
 



Route::post('/add-ph', [PortfolioController::class, 'store']);


use App\Http\Controllers\StocksController;
Route::post('/add-stock', [StocksController::class, 'store']);
Route::delete('stock/delete/{stock}',[StocksController::class,'delete'])->name('stock.delete');
Route::post('/update-stock', [StocksController::class, 'update'])->name('stock.update');



 use App\Http\Controllers\EventController;

 Route::post('/add-event', [EventController::class, 'store']);

 Route::post('/add-ad', [FolioadminController::class, 'store']);




use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

 use App\Http\Controllers\Dashboardcontroller;
Route::get('/portfolio', [Dashboardcontroller::class, 'index'])->name('dashboard');
 Route::get('/events', [Dashboardcontroller::class, 'events'])->name('events');
 Route::get('/listedsecurities', [Dashboardcontroller::class, 'listed'])->name('listedsecurities');
 Route::get("/dash",[DashboardController::class,'index'])->name('dash');
 Route::get("/port",[DashboardController::class,'indexx'])->name('port');
Route::get('/account-statement', [StocksController::class, 'account'])->name('account-statement');

 



 use App\Http\Controllers\ListedSecurityController;

Route::post('/upload-csv', [ListedSecurityController::class, 'uploadCsv'])->name('uploadCsv');

Route::delete('event/delete/{event}',[EventController::class,'delete'])->name('event.delete');
Route::delete('folioadmin/delete/{folioadmin}',[FolioadminController::class,'delete'])->name('folioadmin.delete');

Route::get('/dash', function () {
    return view('dash');
})->name('dash');



Route::get('/stocks/{id}/edit', [StocksController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [StocksController::class, 'update'])->name('stocks.update');
Route::get('/sell/{id}', [StocksController::class, 'sell'])->name('sell');
Route::post('/sell-stock', [StocksController::class, 'sellStock'])->name('sell.stock');








Route::get('/layout', function () {
     return view('layout');
})->name('layout');






Route::get('/trader-analytics', function () {
    return view('trader-analytics');
})->name('trader-analytics');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

use App\Http\Controllers\TransactionController;



Route::get('/portfolio/{portfolioId}/transactions', [TransactionController::class, 'transactionHistory'])->name('transactions.history');
Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.delete');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

Route::get('/ind-history', [TransactionController::class, 'index'])->name('transactions.history');
Route::get('/stocks/data', [StocksController::class, 'getStocksData']);
















