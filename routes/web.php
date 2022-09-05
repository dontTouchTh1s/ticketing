<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
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
        Route::get('create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('store', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('manage{ticket}', [TicketController::class, 'manage'])->name('tickets.manage');
        Route::patch('change-department', [TicketController::class, 'change_department'])->name('tickets.change_department');
        Route::patch('deactivate', [TicketController::class, 'deactivate'])->name('tickets.deactivate');
        Route::delete('destroy', [TicketController::class, 'destroy'])->name('tickets.destroy');
        // Ticket replies routes
        Route::prefix('replies')->group(function () {
            Route::get('/{ticket}', [ReplyController::class, 'index'])->name('replies');
            Route::get('/create')->name('replies.create');
        });


    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
