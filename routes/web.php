<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Ticket\CreateTicketController;
use App\Http\Controllers\Ticket\ManageTicketController;
use App\Http\Controllers\Ticket\Reply\ReplyController;
use App\Http\Controllers\Ticket\Report\ReportController;
use App\Http\Controllers\Ticket\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard']);
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('tickets');
        Route::get('create', [CreateTicketController::class, 'index'])->name('tickets.create');
        Route::post('store', [CreateTicketController::class, 'store'])->name('tickets.store');
        Route::get('manage{ticket}', [ManageTicketController::class, 'index'])->name('tickets.manage');
        Route::patch('change-department', [ManageTicketController::class, 'change_department'])->name('tickets.change_department');
        Route::patch('deactivate', [ManageTicketController::class, 'deactivate'])->name('tickets.deactivate');
        // Ticket replies routes
        Route::prefix('replies')->group(function () {
            Route::get('/{ticket}', [ReplyController::class, 'index'])->name('replies');
            Route::post('/create', [ReplyController::class, 'store'])->name('replies.create');
            Route::post('/report', [ReportController::class, 'store'])->name('replies.reports.create');
        });


    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
