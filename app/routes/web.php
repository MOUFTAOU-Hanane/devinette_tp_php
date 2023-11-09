<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'show']);
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/show-login',  [HomeController::class, 'showLogin'])->name('show-login');
Route::get('/show-riddle',  [HomeController::class, 'showRiddle'])->name('show-riddle');
Route::post('/register-user', [HomeController::class, 'registerUser'])->name('register-user');
Route::put('/update-profil/{id}', [HomeController::class, 'updateProfil'])->name('update-profil');
Route::get('/show-page-update-profil', [HomeController::class, 'showPageUProfil'])->name('show-update-profil');


Route::post('/login', [HomeController::class, 'loginUser'])->name('login');
Route::post('/user-riddle', [HomeController::class, 'riddle'])->name('user-riddle');





