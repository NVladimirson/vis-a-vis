<?php

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

Auth::routes(
    [
  'register' => false,
  'verify' => true,
  'reset' => false
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/guestbook', [App\Http\Controllers\HomeController::class, 'guestbook'])->name('guestbook');

Route::get('/date', [App\Http\Controllers\HomeController::class, 'date'])->name('date');
