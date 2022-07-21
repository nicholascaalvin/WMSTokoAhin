<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'getIndex']);

//login
Route::get('/login', [LoginController::class, 'getIndex'])->name('login_page');
Route::post('/login', [LoginController::class, 'getData'])->name('login_data');

//register
Route::get('/register', [RegisterController::class, 'getIndex'])->name('register_page');
Route::post('/register', [RegisterController::class, 'storeData'])->name('register_data');
