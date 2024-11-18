<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/',function() {return view('welcome');});

Route::post('/login',[UserController::class, 'login']);
Route::post('/signup',[UserController::class, 'signup']);
Route::post('/forgot',[UserController::class, 'forgotPassword']);
Route::get('/products/get', [ProductController::class, 'getProducts']);
Route::get('/categories/get', [ProductController::class, 'getCategories']);
Route::post('/search', [ProductController::class, 'searchProducts']);
Route::post('/products/setOrder', [OrderController::class, 'setOrder']);
Route::get('/history/get', [OrderController::class, 'getOrderHistory']);
Route::post('/user/edit',[UserController::class, 'editUser']);
Route::post('user/changePassword',[UserController::class, 'changePassword']);