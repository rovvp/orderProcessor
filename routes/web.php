<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
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

//Define the default route which produces the banking application form
Route::get('/orderProcessor', [OrderController::class, 'index'])->middleware('auth');

//Define the form processor route which processes uploaded file and returns the result
Route::post('/upload', [OrderController::class, 'upload'])->middleware('auth');

//disable registration
Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index']);
