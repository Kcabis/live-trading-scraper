<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolioadminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListedSecurityController;
use App\Http\Controllers\TransactionController;






Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');





Route::get('/register', function () {
    return view('registration');
});
Route::post('/register', [RegistrationController::class, 'store']);
Route::post('otp-verification', [RegistrationController::class, 'verifyOtp']);
Route::get('otp-verification/{email}', [RegistrationController::class, 'showOtpForm']);


Route::middleware(['auth'])->group(function () {

    Route::get('/portfolio', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [DashboardController::class, 'events'])->name('events');
    Route::get('/listedsecurities', [DashboardController::class, 'listed'])->name('listedsecurities');
    Route::get('/dash', [DashboardController::class, 'index'])->name('dash');
    Route::get('/port', [DashboardController::class, 'indexx'])->name('port');
    Route::get('/trader-analytics', [DashboardController::class, 'analytics'])->name('trader-analytics');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

    Route::post('/update-portfolio', [PortfolioController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/delete-portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('portfolio.delete');
    Route::get('/history', [PortfolioController::class, 'hist'])->name('history');
    Route::post('/add-portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/dash',[PortfolioController::class,'index'])->name('dash.port');
    
Route::post('/settings/update-details', [RegistrationController::class, 'updateDetails'])->name('settings.updateDetails');
Route::post('/settings/change-password', [RegistrationController::class, 'changePassword'])->name('settings.changePassword');
Route::post('/settings/upload-profile', [RegistrationController::class, 'uploadProfile'])->name('settings.uploadProfile');

    Route::get('/account-statement', [PortfolioController::class, 'account'])->name('account-statement');
    Route::post('/add-ph', [PortfolioController::class, 'store'])->name('add-ph');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::post('/add-stock', [StocksController::class, 'store']);
Route::delete('stock/delete/{stock}',[StocksController::class,'delete'])->name('stock.delete');
Route::post('/update-stock', [StocksController::class, 'update'])->name('stock.update');
Route::get('/stocks/{id}/edit', [StocksController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [StocksController::class, 'update'])->name('stocks.update');
Route::get('/sell/{id}', [StocksController::class, 'sell'])->name('sell');
Route::post('/sell-stock', [StocksController::class, 'sellStock'])->name('sell.stock');
Route::get('/stocks/data', [StocksController::class, 'getStocksData']);



Route::post('/add-event', [EventController::class, 'store']);
Route::post('/add-ad', [FolioadminController::class, 'store']);
Route::delete('event/delete/{event}',[EventController::class,'delete'])->name('event.delete');



Route::post('/loginad', [FolioadminController::class, 'loginad']);
Route::post('/add-ad', [FolioadminController::class, 'store']);
Route::delete('folioadmin/delete/{folioadmin}',[FolioadminController::class,'delete'])->name('folioadmin.delete');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');



Route::get('/portfolio/{portfolioId}/transactions', [TransactionController::class, 'transactionHistory'])->name('transactions.history');
Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.delete');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/ind-history', [TransactionController::class, 'index'])->name('transactions.history');




Route::post('/upload-csv', [ListedSecurityController::class, 'uploadCsv'])->name('uploadCsv');





Route::view('/layout', 'layout')->name('layout');
Route::view('/home','home')->name('home');
Route::get('/dash', function () {
    return view('dash');
})->name('dash');
Route::view('/', 'login');







Route::get('/scrape', [ScrapeController::class, 'scrape'])->name('scrape');


