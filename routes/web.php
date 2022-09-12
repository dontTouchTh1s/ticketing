<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notifications\NotificationController;
use App\Http\Controllers\Tickets\CreateTicketController;
use App\Http\Controllers\Tickets\ManageTicketController;
use App\Http\Controllers\Tickets\Reply\ReplyController;
use App\Http\Controllers\Tickets\Report\ReportController;
use App\Http\Controllers\Tickets\TicketController;
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
    // Tickets routes
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('tickets');
        Route::get('create', [CreateTicketController::class, 'create'])->name('tickets.create');
        Route::post('store', [CreateTicketController::class, 'store'])->name('tickets.store');
        Route::get('manage{ticket}', [ManageTicketController::class, 'index'])->name('tickets.manage');
        Route::patch('change-department', [ManageTicketController::class, 'change_department'])->name('tickets.change_department');
        Route::patch('deactivate', [ManageTicketController::class, 'deactivate'])->name('tickets.deactivate');
        // Tickets replies routes
        Route::prefix('replies')->group(function () {
            Route::get('{ticket}', [ReplyController::class, 'index'])->name('replies');
            Route::post('create', [ReplyController::class, 'store'])->name('replies.create');
        });
        // Tickets reports routes
        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('reports');
            Route::post('create', [ReportController::class, 'store'])->name('reports.create');
        });
    });
    // Notifications routes
    Route::prefix('notifications')->group(function () {
        Route::get('', [NotificationController::class, 'index'])->name('notification');
        Route::get('', [CreateNotificationController::class, 'create'])->name('notification.create');
        Route::post('', [CreateNotificationController::class, 'store'])->name('notification.store');
        Route::delete('', [DeleteNotificationController::class])->name('notification.store');
    });
    // Services Routes
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
