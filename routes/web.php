<?php

use App\Http\Controllers\AdminListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {return view('admin.index');})->name('dashboard');

    //AdminList
    Route::get('adminList', [AdminListController::class, 'adminList'])->name('admin#AdminList');
    Route::get('adminList/delete/{id}', [AdminListController::class, 'DeleteAdminList'])->name('admin#AdminListDelete');
    Route::post('adminList', [AdminListController::class, 'searchAdminList'])->name('admin#AdminListSearch');

    //Category
    Route::get('category', [CategoryController::class, 'category'])->name('admin#Category');
    Route::post('category/create', [CategoryController::class, 'createCategory'])->name('admin#CategoryCreate');
    Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#CategoryDelete');
    Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin#CategoryEdit');
    Route::post('category/edit/{id}', [CategoryController::class, 'updateCategory'])->name('admin#CategoryUpdate');

    //Post
    Route::get('post', [PostController::class, 'post'])->name('admin#Post');
    Route::post('post/create', [PostController::class, 'createPost'])->name('admin#PostCreate');
    Route::get('post/delete/{id}', [PostController::class, 'deletePost'])->name('admin#PostDelete');
    Route::get('post/edit/{id}', [PostController::class, 'editPost'])->name('admin#PostEdit');
    Route::post('post/edit/{id}', [PostController::class, 'updatePost'])->name('admin#PostUpdate');

    //Profile
    Route::get('profile', [ProfileController::class, 'profile'])->name('admin#Profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('admin#ProfileUpdate');
    Route::get('profile/password', [ProfileController::class, 'password'])->name('admin#Password');
    Route::post('profile/passwordChange', [ProfileController::class, 'changePassword'])->name('admin#PasswordChange');

    //TrendPost
    Route::get('trendPost', [TrendPostController::class, 'trendPost'])->name('admin#TrendPost');
    Route::get('trendPost/detail/{id}', [TrendPostController::class, 'trendPostDetail'])->name('admin#TrendPostDetail');

});
