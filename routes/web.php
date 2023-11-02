<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('user-login', [AuthController::class, 'userLogin'])->name('user.login');
Route::get('signup', [AuthController::class, 'signup'])->name('signup');
Route::post('user-signup', [AuthController::class, 'userSignup'])->name('user.signup');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::post('posts', [PostController::class, 'store'])->name('post.create')->middleware('auth');
Route::get('profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
