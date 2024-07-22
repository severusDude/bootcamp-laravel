<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// basic routes
Route::get('/{category}/{news_id}', [NewsController::class, 'read_news']);

// admin routes
Route::group(['middleware' => ['role:admin'], 'prefix' => '/admin'], function () {

    // index users
    Route::view('/users', 'admin.users');

    // manage news
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index_news');
        Route::delete('/{category}/{news_id}', 'delete_news');
    });

    // manage categories (/admin/category)
    Route::controller(CategoryController::class)->prefix('/category')->group(function () {
        Route::get('/', 'index_category');
        Route::post('/create', 'create_category');
        Route::put('/{category}', 'edit_category');
        Route::delete('/{category}', 'delete_category');
    });
});

// editor routes
Route::group(['middleware' => ['role:admin|editor']], function () {
    Route::controller(NewsController::class)->group(function () {
        Route::post('/news/create', 'create_news');
        Route::put('/news/{id}', 'edit_news');
        Route::delete('/news/{id}', 'delete_news');
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
