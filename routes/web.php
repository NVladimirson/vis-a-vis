<?php

use App\Http\Controllers\FirmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
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

Auth::routes(
    [
  'register' => false,
  'verify' => true,
  'reset' => false
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/date', [App\Http\Controllers\HomeController::class, 'date'])->name('date');

Route::post('/toggle_crud', [App\Http\Controllers\HomeController::class, 'toggle_crud'])->name('toggle_crud');

Route::post('/setDate', [App\Http\Controllers\HomeController::class, 'setDate'])->name('setDate');

Route::resource('firms', FirmController::class);

Route::resource('phones', PhoneController::class);



