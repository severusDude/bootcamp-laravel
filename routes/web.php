<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// tips: it is reccommended to use (php artisan route:list) command to read all this routes bullshit

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('homepage', ['title' => 'Homepage']);
})->name('homepage');

// basic routes
Route::get('/{category}/{news_id}', [NewsController::class, 'read_news']);

// standard routes
Route::group([
    'middleware' => ['role:admin|editor|standard'],
    'prefix' => '/{category}/{news_id}'
], function () {

    // manage commments
    Route::controller(CommentController::class)->group(function () {
        Route::post('/', 'create_comment');
        Route::put('/{comment_id}', 'edit_comment');
        Route::delete('/{comment_id}', 'delete_comment');
    });
});

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

// create news
Route::post('/create', [NewsController::class, 'create_news']);

Route::group(['middleware' => ['role:editor'], 'prefix' => '/{category}/{news_id}'], function () {

    // editor manage news
    Route::controller(NewsController::class)->group(function () {
        Route::put('/', 'edit_news');
        Route::delete('/', 'delete_news');
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
