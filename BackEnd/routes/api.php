<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// register -- post
Route::post('register', [ProductController::class, 'register']);
// login -- post
Route::post('login', [ProductController::class, 'login']);
// logout -- post
Route::post('logout', [ProductController::class, 'logout']);

// create -- post
Route::post('products', [ProductController::class, 'create']);
// read -- get
Route::get('products', [ProductController::class, 'read']);
// read(id) -- get
Route::get('products/{id}', [ProductController::class, 'read_id']);
// delete -- delete
Route::delete('products', [ProductController::class, 'delete']);
// update -- put
Route::put('products', [ProductController::class, 'update']);