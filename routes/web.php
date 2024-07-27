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
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\QuotesCartsController;
use App\Http\Controllers\QuotesProductsController;

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

Route::put('/users/id_users_roles', [UsersController::class, 'updateIdUsersRoles']);

Route::get('/products', [ProductsController::class, 'show']);
Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products', [ProductsController::class, 'update']);
Route::delete('/products', [ProductsController::class, 'delete']);

Route::get('/contacts', [ContactsController::class, 'show']);
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/blog', [BlogController::class, 'show']);
Route::post('/blog', [BlogController::class, 'store']);
Route::put('/blog', [BlogController::class, 'update']);
Route::delete('/blog', [BlogController::class, 'delete']);

Route::get('/carts', [QuotesCartsController::class, 'show']);
Route::put('/carts', [QuotesCartsController::class, 'update']);
Route::post('/carts', [QuotesCartsController::class, 'store']);
Route::delete('/carts', [QuotesCartsController::class, 'delete']);

Route::get('/quotes', [QuotesController::class, 'show']);
Route::post('/quotes', [QuotesController::class, 'store']);
Route::put('/quotes', [QuotesController::class, 'update']);
Route::delete('/quotes', [QuotesController::class, 'delete']);

Route::get('/quotes/downloadpdf', [QuotesController::class, 'downloadPdf']);

Route::post('/quotesProducts', [QuotesProductsController::class, 'show']);



Route::get('/', [WebController::class, 'show']);
Route::get('/catalogo', [CatalogueController::class, 'show']);
Route::get('/miscotizaciones', [QuotesController::class, 'showMe']);





