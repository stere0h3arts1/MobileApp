<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Models\User;

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
Route::post('register', [SubjectController::class, 'register']);
// login -- post
Route::post('login', [SubjectController::class, 'login']);
// logout -- post
Route::post('logout', [SubjectController::class, 'logout']);

// create -- post
Route::post('subject', [SubjectController::class, 'create']);
// read -- get
Route::get('subject', [SubjectController::class, 'read']);
// read(id) -- get
Route::get('subject/{id}', [SubjectController::class, 'read_id']);
// delete -- delete
Route::delete('subject/{id}', [SubjectController::class, 'destroy']);
// update -- put
Route::put('subject/{id}', [SubjectController::class, 'update']);