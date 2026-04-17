<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\GuestbookController;

Route::get('/', [GuestbookController::class, 'index'])->name('guestbook.index');
Route::post('/', [GuestbookController::class, 'store'])->name('guestbook.store');
