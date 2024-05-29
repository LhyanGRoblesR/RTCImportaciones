<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\RememberPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebController;


Route::get('/laravel', function () {
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


Route::get('/categories', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories', [CategoriesController::class, 'update']);
Route::delete('/categories', [CategoriesController::class, 'delete']);

Route::get('/users', [UsersController::class, 'show']);
Route::put('/users', [UsersController::class, 'update']);
Route::delete('/users', [UsersController::class, 'delete']);



Route::get('/', [WebController::class, 'show']);


