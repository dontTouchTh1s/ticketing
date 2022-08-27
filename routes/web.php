<?php

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

Route::prefix('admin')->group(function() {
    Route::prefix('tickets')->group(function() {
        Route::get('/', [TicketController::class, 'index']);
        Route::get('create', [TicketController::class, 'create']);
        Route::post('store', [TicketController::class, 'store']);
        Route::get('show', [TicketController::class, 'show']);
        Route::get('edit', [TicketController::class, 'edit']);
        Route::patch('update', [TicketController::class, 'update']);
        Route::delete('destroy', [TicketController::class, 'destroy']);


    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
