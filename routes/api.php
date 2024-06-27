<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get("/products", [ProductController::class, "index"]);
Route::post("/product", [ProductController::class, "store"]);
Route::get("/product/{slug}", [ProductController::class, "find"]);
Route::patch("/product", [ProductController::class, "update"]);
Route::delete("/product/{id}", [ProductController::class, "destroy"]);
Route::get('/export-product',[ProductController::class, 'export']);
