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

Route::get('/', [HomeController::class, 'show']);
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register-user', [HomeController::class, 'registerUser'])->name('register-user');
Route::put('/update-profil/{id}', [HomeController::class, 'updateProfil'])->name('update-profil');
Route::get('/delete-profil/{id}',  [HomeController::class, 'deleteUser'])->name('delete-profil');
Route::get('/show-login',  [HomeController::class, 'showLogin'])->name('show-login');
Route::get('/show-profil',  [HomeController::class, 'showProfil'])->name('show-profil');
Route::get('/show-riddle',  [HomeController::class, 'showRiddle'])->name('show-riddle');
Route::get('/show-page-update-profil', [HomeController::class, 'showPageUProfil'])->name('show-update-profil');
Route::get('/show-like-word', [HomeController::class, 'showLikeWordPage'])->name('show-like-word');
Route::post('/login', [HomeController::class, 'loginUser'])->name('login');
Route::post('/user-riddle', [HomeController::class, 'riddle'])->name('user-riddle');
Route::post('/like-word', [HomeController::class, 'likeWord'])->name('like-word');
Route::get('/show-users-score', [HomeController::class, 'userScore'])->name('show-users-score');
Route::get('/historique/{id}', [HomeController::class, 'historique'])->name('historique');
Route::get('/users', [HomeController::class, 'listingUser'])->name('users');
Route::get('/users-friend/{id}', [HomeController::class, 'addFriend'])->name('users-friend');













