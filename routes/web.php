<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Public routes

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{id}', [NewsController::class, 'store_comment']);
Route::put('/news/{news_id}/{id}', [CommentController::class, 'update']);
Route::delete('/news/{news_id}/{id}', [CommentController::class, 'destroy']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('/admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::patch('/news/{id}/restore', [NewsController::class, 'restore'])->name('news.restore');
        Route::resource('news', NewsController::class);
        Route::post('/news/upload', [NewsController::class, 'uploadImage'])->name('news.upload');
    });
});
