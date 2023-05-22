<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[\App\Http\Controllers\WebController::class,"home"]);
Route::get("/shop",[\App\Http\Controllers\WebController::class,"shop"]);
Route::get("/search",[\App\Http\Controllers\WebController::class,"search"]);
Route::get("/category/{category:slug}",[\App\Http\Controllers\WebController::class,"category"]);
Route::get("/cart",[\App\Http\Controllers\WebController::class,"cart"]);
Route::get("/add-to-cart/{product}",[\App\Http\Controllers\WebController::class,"addToCart"]);
Route::get("/checkout",[\App\Http\Controllers\WebController::class,"checkout"]);
Route::post("/checkout",[\App\Http\Controllers\WebController::class,"placeOrder"]);
Route::get("/thank-you/{order}",[\App\Http\Controllers\WebController::class,"thankYou"]);
Route::get('success-transaction,{order}', [\App\Http\Controllers\WebController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction/{order}', [\App\Http\Controllers\WebController::class, 'cancelTransaction'])->name('cancelTransaction');
