<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('user-list-all',[AuthController::class, 'users']);
    Route::get('useractive', [AuthController::class, 'userInfo']);

    Route::get('article-list-all', [PostsController::class, 'index']);
    Route::get('article/show/detail/{id}', [PostsController::class, 'show']);
    Route::post('article/create', [PostsController::class, 'store']);
    Route::post('/article/{id}/update', [PostsController::class, 'update']);
    Route::delete('/article/delete/{id}', [PostsController::class, 'destroy']);

    Route::get('categories-list-all', [CategoryController::class, 'index']);
    Route::get('categories/show/detail/{id}', [CategoryController::class, 'show']);
    Route::post('categories/create', [CategoryController::class, 'store']);
    Route::put('/categories/{id}/update', [CategoryController::class, 'update']);
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy']);
});