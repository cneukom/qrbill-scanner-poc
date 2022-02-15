<?php

use App\Http\Controllers\AppController;
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

Route::get('/', [AppController::class, 'index']);
Route::post('/logout', [AppController::class, 'logout']);
Route::get('/listen', [AppController::class, 'listen']);
Route::get('/scan/{token}', [AppController::class, 'registerScanner']);
Route::get('/scan', [AppController::class, 'remoteScan']);
Route::post('/scans', [AppController::class, 'postScan']);
