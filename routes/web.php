<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailsController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashController;
use App\Http\Controllers\karyawanController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [dashController::class , 'index'])->middleware('auth');
Route::resource('/mail', MailsController::class)->middleware('auth');
Route::resource('/disposisi', DisposisiController::class)->middleware('auth');
Route::resource('/karyawan' , karyawanController::class)->middleware('auth');
