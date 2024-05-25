<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\RememberPasswordController;
use App\Http\Controllers\ChangePasswordController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/verifiedEmail', [RegisterController::class, 'verifiedEmail']);

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::post('/validateDocument', [ToolsController::class, 'validateDocument']);

Route::get('/rememberPassword', [RememberPasswordController::class, 'show']);
Route::post('/rememberPassword', [RememberPasswordController::class, 'rememberPassword']);

Route::get('/changePassword', [ChangePasswordController::class, 'show']);
Route::post('/changePassword', [ChangePasswordController::class, 'changePassword']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/testing', [ToolsController::class, 'testing']);


