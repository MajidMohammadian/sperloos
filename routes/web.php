<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::get('install', [InstallController::class, 'index']);

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::resource('post', PostController::class);
