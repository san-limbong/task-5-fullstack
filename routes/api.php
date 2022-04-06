<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportController;
use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[PassportController::class, 'login']);

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('user',[PassportController::class, 'users']);

    Route::get('article', [PostsController::class, 'index']);
    Route::get('article/{id}', [PostsController::class, 'show']);
    Route::put('/article/{id}/change', [PostsController::class, 'update']);
    Route::post('article/develop', [PostsController::class, 'store']);
    Route::delete('/article/{id}', [PostsController::class, 'destroy']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::post('categories/develop', [CategoryController::class, 'store']);
    Route::put('/categories/{id}/change', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});