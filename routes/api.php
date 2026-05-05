<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth
Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

//Category
Route::get('category', [CategoryController::class, 'category']);
Route::post('category/search', [CategoryController::class, 'categorySearch']);

//Post
Route::get('allPosts', [PostController::class, 'allPosts']);
Route::post('post/search', [PostController::class, 'postSearch']);
Route::post('post/detail', [PostController::class, 'postDetail']);
Route::post('post/actionLog', [PostController::class, 'postActionLog']);
